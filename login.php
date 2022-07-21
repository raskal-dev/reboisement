<?php
session_start();
if(!empty($_POST) && !empty($_POST['identifiant']) && !empty($_POST['password']))
{
    require_once "includes/function.php";
    require_once "includes/db.php";

    $sql="SELECT users.id,users.nom,users.prenom,users.identifiant,users.confirme,users.password,role.id as role_id,role.name,role.slug,role.level,diredd_dredd_ciredd.id_diredd_dredd_ciredd,diredd_dredd_ciredd.nom_diredd_dredd_ciredd,region.nom_region,region.id as region_id
         FROM users
         LEFT JOIN role ON users.role_id=role.id
         LEFT JOIN diredd_dredd_ciredd_region ON diredd_dredd_ciredd_region.id_diredd_dredd_ciredd=users.id_diredd_dredd_ciredd
         LEFT JOIN region ON diredd_dredd_ciredd_region.id_region=region.id
         LEFT JOIN diredd_dredd_ciredd ON diredd_dredd_ciredd.id_diredd_dredd_ciredd=diredd_dredd_ciredd_region.id_diredd_dredd_ciredd
         WHERE identifiant=:identifiant OR mail=:identifiant";
    $req=$db->prepare($sql);
    $req->bindValue(':identifiant',$_POST['identifiant'],PDO::PARAM_STR);
    $req->execute();
    $users=$req->fetch(PDO::FETCH_ASSOC);
    if(password_verify($_POST['password'], $users['password']) && isset($users['identifiant']) && $users['confirme']==1)
    {
        $_SESSION['authentifier']=$users;
        $_SESSION['last_accessrbsmt']=time();
        $_SESSION['flash']['success']="Vous êtes maintenant connécté";
        header('location:accueil.php');
        exit();
    }else
    {
        $_SESSION['flash']['danger']="Identifiant ou mot de passe incorrecte OU BIEN que votre compte n'a pas encore été confirmé par un Administrateur";
        header('location:login.php');
        exit();
    }
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
                                <div class="login">
                                <h3>Connexion</h3>
                                    <div class="form-group">
                                        <label for="1">Identifiant ou Email</label>
                                        <input type="text" name="identifiant" class="form-control" id="1"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="2">Mot de passe</label>
                                        <input type="password" name="password" class="form-control" id="2"/>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Se connecter</button>
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
<?php

require_once ('includes/footer.php');
?>
