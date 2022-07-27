<?php
session_start();
require_once 'includes/function.php';
require_once'includes/db.php';
$Fonction->logged_only();
$Fonction->allow('member');

if(isset($_POST['espece'])){

     $id_pepiniere=trim($Fonction->secure($_POST['espece'][$id_pepiniere]));
    
    for($count = 0; $count < count($_POST['nombrePlantSorti']); $count++)
    {
        
            $_POST['espece'][$count]=trim($Fonction->secure($_POST['espece'][$count]));
            $_POST['nombrePlantSorti'][$count]=trim($Fonction->secure($_POST['nombrePlantSorti'][$count]));
            $_POST['nom_beneficiaire'][$count]=trim($Fonction->secure($_POST['nom_beneficiaire'][$count]));
            $_POST['dateSorti'][$count]=trim($Fonction->secure($_POST['dateSorti'][$count]));
            $_POST['contact_beneficiare'][$count]=trim($Fonction->secure($_POST['contact_beneficiare'][$count]));
            $_POST['lieu_reboisement'][$count]=trim($Fonction->secure($_POST['lieu_reboisement'][$count]));

            $query="INSERT INTO `essence_pepiniere_sorti`( `espece`,  `nombrePlantSorti`,`dateSorti`, `nom_beneficiaire`,`contact_beneficiare`,`lieu_reboisement`, `id_pepiniere`)
                    VALUES( :espece,  :nombrePlantSorti,:dateSorti, :nom_beneficiaire,:contact_beneficiare,:lieu_reboisement, :id_pepiniere)";
            $statement = $db->prepare($query);
            $statement->execute(array(
                                    'espece'=>$_POST['espece'][$count],
                                    'nombrePlantSorti'=>$_POST['nombrePlantSorti'][$count],
                                    'dateSorti'=>$_POST['dateSorti'][$count],
                                    'nom_beneficiaire'=>$_POST['nom_beneficiaire'][$count],
                                    'contact_beneficiare'=>$_POST['contact_beneficiare'][$count],
                                    'lieu_reboisement'=>$_POST['lieu_reboisement'][$count],
                                    'id_pepiniere'=>$id_pepiniere
                                      ));
    }
}

unset($_SESSION['id_pepiniere']);
?>