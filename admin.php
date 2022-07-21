<?php
session_start();
require_once 'includes/function.php';
require_once'includes/db.php';
$Fonction->logged_only();
//$Fonction->allow('admin');
 unset($_SESSION['id_stocks']);
unset($_SESSION['inputs']);
unset($_SESSION['district']);
unset($_SESSION['commune']);
unset($_SESSION['params']);
unset($_SESSION['reboisement_id']);
unset($_SESSION['nom_vernac']);
unset($_SESSION['region']);
unset($_SESSION['nom_region']);
unset($_SESSION['nom_district']);
unset($_SESSION['id_pepiniere']);
unset($_SESSION['pepinieriste']);

if(isset($_GET['confirme']) AND !empty($_GET['confirme']))
{
    $confirme=(int) $_GET['confirme'];
    $sql="UPDATE users SET confirme=1 WHERE id=?";
    $req=$db->prepare($sql);
    $req->execute(array($confirme));
    
    $_SESSION['flash']['success']="Compte confirmé!!";
    header('location:admin.php');
    exit();
}

if(isset($_GET['del']) AND !empty($_GET['del']))
{
    $del=(int) $_GET['del'];
    $sql="UPDATE users SET confirme=0 WHERE id=?";
    $req=$db->prepare($sql);
    $req->execute(array($del));
    
    $_SESSION['flash']['success']="Données supprimées!!";
    if($Fonction->user('id')==$del)
    {
      header('location:index.php');
      session_destroy();
    }else
    {
      header('location:admin.php');
    }
    exit();
}

if($Fonction->user('level')>=3)
{
   $diredd_dredd_ciredd='%';
}else
{
   if($Fonction->user('level')<=2)
   {
         $diredd_dredd_ciredd=$_SESSION['authentifier']['id_diredd_dredd_ciredd'];
   }
}

if($Fonction->user('level')>=3)
{
   $level=$_SESSION['authentifier']['level'];
}else
{
   if($Fonction->user('level')<=2)
   {
         $level= $_SESSION['authentifier']['level'];
   }
}

if($Fonction->user('level')>=3 || $Fonction->user('level')==2)
{
   $confirme=0;
}
else
{
   $confirme=1; 
}

$sql="SELECT users.id,users.nom,users.prenom,users.identifiant,users.mail,users.password,users.confirme,diredd_dredd_ciredd.nom_diredd_dredd_ciredd,role.id AS role_id,role.slug,role.level,role.name
      FROM users
      LEFT JOIN diredd_dredd_ciredd ON users.id_diredd_dredd_ciredd=diredd_dredd_ciredd.id_diredd_dredd_ciredd
      LEFT JOIN role ON users.role_id=role.id
      WHERE users.id_diredd_dredd_ciredd LIKE '$diredd_dredd_ciredd'
      AND role.level <= $level
      AND users.confirme >= $confirme
      ORDER BY id DESC";
$info_users=$db->query($sql);
?>

<?php
require_once ('includes/header.php');
require_once ('includes/scripts.php'); 
require_once ('includes/navbar.php'); 
?>
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-body">
         
         
<h3>Vous êtes connecté en tant que "<?= $_SESSION['authentifier']['name'] ?>" dans le Site(<?= $_SESSION['authentifier']['nom_diredd_dredd_ciredd'] ?>)</h3>
<h1>Bienvenue <?= $_SESSION['authentifier']['identifiant'] ?></h1>
<?php if($Fonction->user('level')>=2):?>

   <a class="btn btn-primary btn-sm" href="register.php" role="button">Nouvel utilisateur</a>
   <a class="btn btn-danger btn-sm" href="deletelog.php">Historique de suppression</a>

<?php endif;?>
<div class="row">
    <div class="col-sm-10">
    <div class="scrollable">
        <table class="table">
            <thead>
                <tr><th>Nom et Prénom</th><th>Identifiant</th><th>Email</th><th>Role</th><th>Site</th></tr>
            </thead>
            <tbody>
                <?php while($info_user=$info_users->fetch()):?>
                    <tr>
                        <td><?= $info_user->nom ?>&nbsp;&nbsp;<?= $info_user->prenom ?></td>
                        <td><?= $info_user->identifiant ?></td>
                        <td><?= $info_user->mail ?></td>
                        <td><?= $info_user->name ?></td>
                        <td><?= $info_user->nom_diredd_dredd_ciredd ?></td>
                        
                        <?php if($Fonction->user('level')==2 && $Fonction->user('role_id')==2 && $Fonction->user('nom_diredd_dredd_ciredd')==$info_user->nom_diredd_dredd_ciredd): ?>
                            <?php if($info_user->confirme==0): ?>
                                <td><a href="admin.php?confirme=<?=$info_user->id ?>"  onclick="return(confirm('Etes-vous sûr de vouloir confirmer la commande'));"><span class="fas fa-check"></span></a></td>
                            <?php else:?>
                              <?php if($info_user->level==2 && $info_user->role_id==2 && $Fonction->user('nom_diredd_dredd_ciredd')==$info_user->nom_diredd_dredd_ciredd): ?>
                                 <td><a><span class="fas fa-trash"></span></a></td>
                              <?php else:?>
                                 <td><a href="admin.php?del=<?=$info_user->id ?>"  onclick="return(confirm('Etes-vous sûr de vouloir supprimer la ligne'));"><span class="fas fa-trash"></span></a></td>
                              <?php endif;?>
                            <?php endif;?>
                            
                            <?php if($info_user->level==2 && $info_user->role_id==2 && $Fonction->user('nom_diredd_dredd_ciredd')==$info_user->nom_diredd_dredd_ciredd && $Fonction->user('identifiant')==$info_user->identifiant): ?>
                                <td><a href="register.php?update=<?=$info_user->id ?>"><span class="fas fa-pen-fancy"></span></a></td>
                            <?php elseif($info_user->level==2 && $info_user->role_id==2 && $Fonction->user('nom_diredd_dredd_ciredd')==$info_user->nom_diredd_dredd_ciredd && $Fonction->user('identifiant')!=$info_user->identifiant):?>
                                 <td><a><span class="fas fa-pen-fancy"></span></a></td>
                            <?php else:?>
                                <td><a href="register.php?update=<?=$info_user->id ?>"><span class="fas fa-pen-fancy"></span></a></td>
                            <?php endif;?>
                            
                            <?php if($info_user->level==2 && $info_user->role_id==2 && $Fonction->user('nom_diredd_dredd_ciredd')==$info_user->nom_diredd_dredd_ciredd && $Fonction->user('identifiant')==$info_user->identifiant): ?>
                                <td><a href="register.php?MDP=<?=$info_user->id ?>"><span class="fas fa-sync-alt"></span></a></td>
                            <?php elseif($info_user->level==2 && $info_user->role_id==2 && $Fonction->user('nom_diredd_dredd_ciredd')==$info_user->nom_diredd_dredd_ciredd && $Fonction->user('identifiant')!=$info_user->identifiant):?>
                                 <td><a><span class="fas fa-sync-alt"></span></a></td>
                            <?php else:?>
                                <td><a href="register.php?MDP=<?=$info_user->id ?>"><span class="fas fa-sync-alt"></span></a></td>
                            <?php endif;?>
                                
                        <?php elseif($Fonction->user('level')==2 && $Fonction->user('role_id')==4 && $Fonction->user('nom_diredd_dredd_ciredd')==$info_user->nom_diredd_dredd_ciredd): ?>
                            <?php if($info_user->confirme==0): ?>
                                <td><a href="admin.php?confirme=<?=$info_user->id ?>"  onclick="return(confirm('Etes-vous sûr de vouloir confirmer la commande'));"><span class="fas fa-check"></span></a></td>
                            <?php else:?>
                              <?php if($info_user->level==2 && $info_user->role_id==4 && $Fonction->user('nom_diredd_dredd_ciredd')==$info_user->nom_diredd_dredd_ciredd && $Fonction->user('identifiant')==$info_user->identifiant): ?>
                                 <td><a href="admin.php?del=<?=$info_user->id ?>"  onclick="return(confirm('Etes-vous sûr de vouloir supprimer la ligne'));"><span class="fas fa-trash"></span></a></td>
                              <?php else:?>
                                 <td><a><span class="fas fa-trash"></span></a></td>
                              <?php endif;?>
                            <?php endif;?>
                            
                            <?php if($info_user->level==2 && $info_user->role_id==4 && $Fonction->user('nom_diredd_dredd_ciredd')==$info_user->nom_diredd_dredd_ciredd && $Fonction->user('identifiant')==$info_user->identifiant): ?>
                                <td><a href="register.php?update=<?=$info_user->id ?>"><span class="fas fa-pen-fancy"></span></a></td>
                            <?php elseif($info_user->level==2 && $info_user->role_id==2 && $Fonction->user('nom_diredd_dredd_ciredd')==$info_user->nom_diredd_dredd_ciredd): ?>
                                <td><a><span class="fas fa-pen-fancy"></span></a></td>
                            <?php else:?>
                                <td><a><span class="fas fa-pen-fancy"></span></a></td>
                            <?php endif;?>
                            
                            <?php if($info_user->level==2 && $info_user->role_id==4 && $Fonction->user('nom_diredd_dredd_ciredd')==$info_user->nom_diredd_dredd_ciredd && $Fonction->user('identifiant')==$info_user->identifiant): ?>
                                <td><a href="register.php?MDP=<?=$info_user->id ?>"><span class="fas fa-sync-alt"></span></a></td>
                            <?php elseif($info_user->level==2 && $info_user->role_id==2 && $Fonction->user('nom_diredd_dredd_ciredd')==$info_user->nom_diredd_dredd_ciredd):?>
                                 <td><a><span class="fas fa-sync-alt"></span></a></td>
                            <?php else:?>
                                <td><a href="register.php?MDP=<?=$info_user->id ?>"><span class="fas fa-sync-alt"></span></a></td>
                            <?php endif;?>
                                
                        <?php elseif($Fonction->user('level')==1 && $Fonction->user('nom_diredd_dredd_ciredd')==$info_user->nom_diredd_dredd_ciredd && $Fonction->user('identifiant')==$info_user->identifiant): ?>
                           <td><a href="admin.php?del=<?=$info_user->id ?>"  onclick="return(confirm('Etes-vous sûr de vouloir supprimer la ligne'));"><span class="fas fa-trash"></span></a></td>
                           <td><a href="register.php?update=<?=$info_user->id ?>"><span class="fas fa-pen-fancy"></span></a></td>
                           <td><a href="register.php?MDP=<?=$info_user->id ?>"><span class="fas fa-sync-alt"></span></a></td>
                        <?php elseif($Fonction->user('level')>=3): ?>
                            <?php if($info_user->confirme==0): ?>
                                <td><a href="admin.php?confirme=<?=$info_user->id ?>" onclick="return(confirm('Etes-vous sûr de vouloir confirmer la commande'));"><span class="fas fa-check"></a></td>
                            <?php else:?>
                              <?php if($Fonction->user('identifiant')==$info_user->identifiant): ?>
                                 <td><a><span class="fas fa-trash"></span></a></td>
                              <?php else:?>
                                 <td><a href="profil.php?del=<?=$info_user->id ?>"  onclick="return(confirm('Etes-vous sûr de vouloir supprimer la ligne'));"><span class="fas fa-trash"></span></a></td>
                              <?php endif;?>
                            <?php endif;?>
                                <!--<td><a href="admin.php?del=<?=$info_user->id ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer la ligne'));"><span class="glyphicon glyphicon-trash"></span></a></td>-->
                                <td><a href="register.php?update=<?=$info_user->id ?>"><span class="fas fa-pen-fancy"></span></a></td>
                                <td><a href="register.php?MDP=<?=$info_user->id ?>"><span class="fas fa-sync-alt"></span></a></td>
                        <?php endif;?>
                    </tr>
                <?php endwhile ;?>
            </tbody>
        </table>
    </div>
    </div>
</div>

</div>
</div>
</div>
<?php require 'includes/footer.php' ; ?>