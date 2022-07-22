<?php
session_start();
require_once "includes/function.php";
require_once "includes/db.php";

if($Fonction->user('level')>=3 || $Fonction->user('level')=='')
{
   $site='%';
}else
{
   if($Fonction->user('level')==2)
   {
         $site=$_SESSION['authentifier']['id_diredd_dredd_ciredd'];
   }
}
if(isset($site))
{
   $sql="SELECT * FROM diredd_dredd_ciredd WHERE id_diredd_dredd_ciredd LIKE '$site' ORDER BY nom_diredd_dredd_ciredd ASC";
   $req=$db->prepare($sql);
   $req->execute();
   $recs=$req->fetchAll();
}

$update="";

if(isset($_GET['update']))
{
   $id=(int) $_GET['update'];
   $sql="SELECT users.id AS userID,users.identifiant,users.nom,users.prenom,users.mail,users.password,users.confirme,diredd_dredd_ciredd
.id_diredd_dredd_ciredd,diredd_dredd_ciredd.nom_diredd_dredd_ciredd,role.id AS roleID,role.slug,role.level,role.name
        FROM users
        LEFT JOIN diredd_dredd_ciredd ON diredd_dredd_ciredd.id_diredd_dredd_ciredd=users.id_diredd_dredd_ciredd
        LEFT JOIN role ON users.role_id=role.id
        WHERE users.id=?";
   $req=$db->prepare($sql);
   $req->execute([$id]);
   $update=$req->fetch();
}

if(isset($_POST['valider']))
{
   $erreurs=array();
   
   if(empty($_POST['nom']))
   {
      $erreurs['nom']="Veuillez renseigner le champ nom!!";
   }else
   {
      if(!preg_match('/^[a-zA-Z ]+$/',$_POST['nom']))
      {
         $erreurs['nom']="Votre nom n'est pas valide(alphabétique)";
      }
   }
   
   if(empty($_POST['prenom']))
   {
      $erreurs['prenom']="Veuillez renseigner le champ prenom!!";
   }else
   {
      if(!preg_match('/^[a-zA-Z ]+$/',$_POST['prenom']))
      {
         $erreurs['prenom']="Votre prenom n'est pas valide(alphabétique)";
      }
   }
   
   if(empty($_POST['identifiant']) || !preg_match('/^[a-zA-Z0-9 ]+$/',$_POST['identifiant']))
   {
      $erreurs['identifiant']="Votre identifiant n'est pas valide(alphanumérique)";
   }else
   {
      $sql="SELECT id FROM users WHERE identifiant=:identifiant";
      $req=$db->prepare($sql);
      $req->bindValue(':identifiant',$_POST['identifiant'],PDO::PARAM_STR);
      $req->execute();
      $users=$req->fetch();
      if($users)
      {
         $erreurs['identifiant']="Cet identifiant est déjà utilisé";
      }
   }
   
   if(empty($_POST['mail']) || !filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL))
   {
      $erreurs['mail']="Votre email n'est pas valide";
   }else
   {
      $sql="SELECT id FROM users WHERE mail=:mail";
      $req=$db->prepare($sql);
      $req->bindValue(':mail',$_POST['mail'],PDO::PARAM_STR);
      $req->execute();
      $users=$req->fetch();
      if($users)
      {
         $erreurs['mail']="Cet email est déjà utilisé pour un autre compte";
      }
   }
   
   if(empty($_POST['diredd_dredd_ciredd']))
   {
      $erreurs['diredd_dredd_ciredd']="Veuillez renseigner le champ Site!!";
   }
   
   if(empty($_POST['role']))
   {
      $erreurs['role']="Veuillez renseigner le champ Role!!";
   }
   
   if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm'])
   {
      $erreurs['password']="Mot de passe et mot de passe de confirmation ne correspondent pas";
   }
   
   if(empty($erreurs))
   {
      $role=(int) $_POST['role'];
      $nom=$Fonction->secure($_POST['nom']);
      $prenom=$Fonction->secure($_POST['prenom']);
      $identifiant=$Fonction->secure($_POST['identifiant']);
      $diredd_dredd_ciredd=$Fonction->secure($_POST['diredd_dredd_ciredd']);
      $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
      $sql="INSERT INTO users(nom,prenom,identifiant,mail,confirme,password,id_diredd_dredd_ciredd,role_id) VALUES(:nom,:prenom,:identifiant,:mail,'0',:password,:id_diredd_dredd_ciredd,:role_id)";
      $req=$db->prepare($sql);
      $req->bindValue(':nom',$nom,PDO::PARAM_STR);
      $req->bindValue(':prenom',$prenom,PDO::PARAM_STR);
      $req->bindValue(':identifiant',$identifiant,PDO::PARAM_STR);
      $req->bindValue(':mail',$_POST['mail'],PDO::PARAM_STR);
      $req->bindValue(':id_diredd_dredd_ciredd',$diredd_dredd_ciredd,PDO::PARAM_STR);
      $req->bindValue(':password',$password,PDO::PARAM_STR);
      $req->bindValue(':role_id',$role,PDO::PARAM_STR);
      $req->execute();
      
      $_SESSION['flash']['success']="Votre compte a bien été créer. Vous êtes invité à confirmer votre compte auprès d'un Administrateur!!";
      if($Fonction->user('level')>=2)
      {
         header('location:admin.php');
         exit();
      }else
      {
         header('location:login.php');
         exit();
      }
      
   }   
}

if(isset($_POST['modifier']))
{
   if(isset($_GET['update']))
   {
      $erreurs=array();
      
      if(empty($_POST['nom']))
      {
         $erreurs['nom']="Veuillez renseigner le champ nom!!";
      }else
      {
         if(!preg_match('/^[a-zA-Z ]+$/',$_POST['nom']))
         {
            $erreurs['nom']="Votre nom n'est pas valide(alphabétique)";
         }
      }
   
      if(empty($_POST['identifiant']) || !preg_match('/^[a-zA-Z0-9 ]+$/',$_POST['identifiant']))
      {
         $erreurs['identifiant']="Votre identifiant n'est pas valide(alphanumérique)";
      }else
      {
         $sql="SELECT id FROM users WHERE identifiant=:identifiant";
         $req=$db->prepare($sql);
         $req->bindValue(':identifiant',$_POST['identifiant'],PDO::PARAM_STR);
         $req->execute();
         $users=$req->fetch();
         if($users && $_POST['identifiant'] != $update->identifiant)
         {
            $erreurs['identifiant']="Cet identifiant est déjà utilisé";
         }
      }
      
      if(empty($_POST['mail']) || !filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL))
      {
         $erreurs['mail']="Votre email n'est pas valide";
      }else
      {
         $sql="SELECT id FROM users WHERE mail=:mail";
         $req=$db->prepare($sql);
         $req->bindValue(':mail',$_POST['mail'],PDO::PARAM_STR);
         $req->execute();
         $users=$req->fetch();
         if($users && $_POST['mail'] != $update->mail)
         {
            $erreurs['mail']="Cet email est déjà utilisé pour un autre compte";
         }
      }
      
      if(empty($_POST['diredd_dredd_ciredd']))
      {
         $erreurs['diredd_dredd_ciredd']="Veuillez renseigner le champ Site!!";
      }
      
      if(empty($_POST['role']))
      {
         $erreurs['role']="Veuillez renseigner le champ Role!!";
      }
      
      //if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm'])
      //{
      //   $erreurs['password']="Mot de passe et mot de passe de confirmation ne correspondent pas";
      //}
      
      if(empty($erreurs))
      {
         $id=(int) $_GET['update'];
         $role=(int) $_POST['role'];
         $nom=$Fonction->secure($_POST['nom']);
         $prenom=$Fonction->secure($_POST['prenom']);
         $identifiant=$Fonction->secure($_POST['identifiant']);
         $diredd_dredd_ciredd=$Fonction->secure($_POST['diredd_dredd_ciredd']);
         //$password=password_hash($_POST['password'],PASSWORD_BCRYPT);
         $sql="UPDATE users SET nom=:nom,prenom=:prenom, identifiant=:identifiant,mail=:mail,id_diredd_dredd_ciredd=:id_diredd_dredd_ciredd,role_id=:role_id
              WHERE id=:id";
         $req=$db->prepare($sql);
         $req->bindValue(':identifiant',$identifiant,PDO::PARAM_STR);
         $req->bindValue(':mail',$_POST['mail'],PDO::PARAM_STR);
         $req->bindValue(':id_diredd_dredd_ciredd',$diredd_dredd_ciredd,PDO::PARAM_STR);
         //$req->bindValue(':password',$password,PDO::PARAM_STR);
         $req->bindValue(':nom',$nom,PDO::PARAM_STR);
         $req->bindValue(':prenom',$prenom,PDO::PARAM_STR);
         $req->bindValue(':role_id',$role,PDO::PARAM_STR);
         $req->bindValue(':id',$id,PDO::PARAM_STR);
         $req->execute();
         
         $_SESSION['flash']['success']="Votre compte a bien été modifier!!";
         if($Fonction->user('level')>=2)
         {
            header('location:admin.php');
            exit();
         }else
         {
            header('location:login.php');
            exit();
         }
         
      }
   }else
   {
      if(isset($_GET['MDP']))
      {
         $_GET['MDP']=$Fonction->secure($_GET['MDP']);
         $MDP=(int) $_GET['MDP'];
         if($Fonction->user('level')==1)
			{
				if(empty($_POST['oldpass']))
				{
				  $erreurs['oldpass']="Veuillez indiquer votre ancien mot de passe";
				}else
				{
				  $sql="SELECT password FROM users WHERE id=:id";
				  $result=$db->prepare($sql);
				  $result->execute(array('id'=>$MDP));
				  $pass=$result->fetch();
				  if(password_verify($_POST['oldpass'], $pass->password))
				  {

				  }else
				  {
					 $erreurs['oldpass']="Ancien mot de passe incorrecte";
				  }
				}
			}
         if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm'])
         {
            $erreurs['password']="Mot de passe et mot de passe de confirmation ne correspondent pas";
         }
         
         if(empty($erreurs))
         {
            $_GET['MDP']=$Fonction->secure($_GET['MDP']);
            $id=(int) $_GET['MDP'];
            $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
            $sql="UPDATE users SET password=:password WHERE id=:id";
            $req=$db->prepare($sql);
            $req->bindValue(':password',$password,PDO::PARAM_STR);
            $req->bindValue(':id',$id,PDO::PARAM_STR);
            $req->execute();
            
            $_SESSION['flash']['success']="Votre mot de passe a bien été génerer!!";
            if($Fonction->user('level')>=2)
            {
               header('location:admin.php');
               exit();
            }else
            {
               header('location:account.php');
               exit();
            }
         }
      }
   }
}

if(isset($_POST['retour']))
{
   header('location:admin.php');
   exit();
}

if(isset($_POST['exit']))
{
   header('location:admin.php');
   exit();
}

?>
<?php
require_once ('includes/header.php');
require_once ('includes/scripts.php'); 
require_once ('includes/navbar.php'); 
?>
<?php if(!empty($erreurs)): ?>
   <div class="alert alert-danger" id="messageFlash">
      <p>Vous n'avez pas rempli le formulaire correctement</p>
      <ul>
         <?php foreach($erreurs as $erreur): ?>
            <li><?= $erreur; ?></li>
         <?php endforeach; ?>
      </ul>
   </div>
   <?php endif; ?>
   
<?php if(isset($_GET['MDP'])):?>

     <div class="container-fluid">

<!-- DataTales Example -->
      <div class="card shadow mb-4">
		<div class="card-body">
       <div class="row">
       <div class="col-sm-4"></div>
       <div class="col-sm-4">
       <div class="panel panel-default">
       <div class="panel-body">
       <form action="" method="POST">
      <div class="register">
      <h3>Génerer Mot De Passe</h3>
            <?php if($Fonction->user('level')==1):?>
                 <div class="form-group">
                     <label for="10">Ancien Mot de passe</label>
                     <input  style="border-radius: 2em"  type="password" name="oldpass" class="form-control" id="10"/>
                 </div>
            <?php endif;?>
           <div class="form-group">    
               <label for="4">Mot de passe</label>
               <input type="password" name="password" class="form-control" id="4"/>
           </div>
           <div class="form-group">    
               <label for="5">Confirmer mot de passe</label>
               <input type="password" name="password_confirm" class="form-control" id="5"/>
           </div>
            <button type="submit" name="exit" class="btn btn-danger">Retour</button>
            <button type="submit" name="modifier" class="btn btn-primary" onclick="return(confirm('Etes-vous sûr de vouloir validé les informations'));">Modifier</button>
      </div>
   </form>
   </div>
   </div>
   </div>
   <div class="col-sm-4"></div>
   </div>
   </div>
   </div>
   </div>
   
<?php else:?>

      <div class="container-fluid">

<!-- DataTales Example -->
      <div class="card shadow mb-4">
		<div class="card-body">
       <div class="row">
       <div class="col-sm-4"></div>
       <div class="col-sm-4">
       <div class="panel panel-default">
       <div class="panel-body">
       <form action="" method="POST">
      <div class="register">
      <?php if(isset($_GET['update'])):?>
      <h3>Modification</h3>
      <?php else:?>
       <h3>Inscription</h3>
       <?php endif;?>
            <div class="form-group">
               <label for="1">Nom</label>
               <input type="text" name="nom" class="form-control" id="1" value="<?php if(isset($_GET['update'])){ echo $update->nom;}else{}?>"/>
           </div>
            <div class="form-group">
               <label for="1">Prénom</label>
               <input type="text" name="prenom" class="form-control" id="1" value="<?php if(isset($_GET['update'])){ echo $update->prenom;}else{}?>"/>
           </div>
           <div class="form-group">
               <label for="1">Identifiant</label>
               <input type="text" name="identifiant" class="form-control" id="1" value="<?php if(isset($_GET['update'])){ echo $update->identifiant;}else{}?>"/>
           </div>
           <div class="form-group">    
               <label for="2">Email</label>
               <input type="email" name="mail" class="form-control" id="2" value="<?php if(isset($_GET['update'])){echo $update->mail;}else{}?>"/>
           </div>
           <?php if($Fonction->user('level')>='3'):?>
               <div class="form-group">    
                  <label>Role</label>
                  <select name="role" class="form-control">
                     <option value="<?php if(isset($_GET['update'])){echo $update->roleID;}else{}?>"><?php if(isset($_GET['update'])){echo $update->name;}else{}?></option>
                     <option value="1">Super Administrateur</option>
                     <option value="2">Administrateur</option>
                     <option value="3">Membre</option>
                  </select>
              </div>
            <?php elseif($Fonction->user('level')==2 && $Fonction->user('role_id')==2):?>
               <div class="form-group">    
                  <label>Role</label>
                  <select name="role" class="form-control">
                     <option value="<?php if(isset($_GET['update'])){echo $update->roleID;}else{}?>"><?php if(isset($_GET['update'])){echo $update->name;}else{}?></option>
                     <?php if($update->roleID==3):?>
                        <option value="4">Administrateur supléant</option>
                     <?php endif;?>
                     <?php if($update->roleID==3 || $update->roleID==4):?>
                        <option value="3">Membre</option>
                     <?php endif;?>
                     <?php if($update==''):?>
                        <option value="4">Administrateur supléant</option>
                        <option value="3">Membre</option>
                     <?php endif;?>
                  </select>
               </div>
            <?php elseif($Fonction->user('level')==2 && $Fonction->user('role_id')==4):?>
               <div class="form-group">    
                  <label>Role</label>
                  <select name="role" class="form-control">
                     <option value="<?php if(isset($_GET['update'])){echo $update->roleID;}else{}?>"><?php if(isset($_GET['update'])){echo $update->name;}else{}?></option>
                     <?php if($update==''):?>
                        <option value="3">Membre</option>
                     <?php endif;?>
                  </select>
               </div>
            <?php elseif($Fonction->user('level')==''):?>
               <div class="form-group">    
                  <label>Role</label>
                  <select name="role" class="form-control">
                     <option value="<?php if(isset($_GET['update'])){echo $update->roleID;}else{}?>"><?php if(isset($_GET['update'])){echo $update->name;}else{}?></option>
                     <option value="3">Membre</option>
                  </select>
               </div>
            <?php endif;?>
            <div class="form-group">    
               <label for="3">Site</label>
               <select name="diredd_dredd_ciredd" class="form-control" id="3">
                  <option value="<?php if(isset($_GET['update'])){echo $update->id_diredd_dredd_ciredd;}else{}?>"><?php if(isset($_GET['update'])){echo $update->nom_diredd_dredd_ciredd;}else{}?></option>
                  <?php foreach($recs as $rec): ?>
                  <option value="<?= $rec->id_diredd_dredd_ciredd ?>"><?= $rec->nom_diredd_dredd_ciredd ?></option>
                  <?php endforeach; ?>
               </select>
           </div>
         <?php if(!isset($_GET['update'])):?>
           <div class="form-group">    
               <label for="4">Mot de passe</label>
               <input type="password" name="password" class="form-control" id="4"/>
           </div>
           <div class="form-group">    
               <label for="5">Confirmer mot de passe</label>
               <input type="password" name="password_confirm" class="form-control" id="5"/>
           </div>
         <?php endif;?>
           <?php if($Fonction->user('level')>=2):?>
               <div class="r1">
                   <button type="submit" name="retour" class="btn btn-danger">Retour</button>
                   <?php if(isset($_GET['update'])):?>
                   <button type="submit" name="modifier" class="btn btn-primary" onclick="return(confirm('Etes-vous sûr de vouloir validé les informations'));">Modifier</button>
                   <?php else:?>
                   <button type="submit" name="valider" class="btn btn-primary" onclick="return(confirm('Etes-vous sûr de vouloir validé les informations'));">S'inscrire</button>
                   <?php endif;?>
                </div>
           <?php else:?>
               <button type="submit" name="valider" class="btn btn-primary" onclick="return(confirm('Etes-vous sûr de vouloir validé les informations'));">S'inscrire</button>
            <?php endif;?>
      </div>
   </form>
   </div>
   </div>
   </div>
   <div class="col-sm-4"></div>
   </div>
   </div>
   </div>
   </div>
      
<?php endif;?>

<?php

require_once ('includes/footer.php');
?>