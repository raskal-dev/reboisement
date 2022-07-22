<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/function.php';
$Fonction->logged_only();
if(!empty($_POST['id_district']))
{
    $sql="SELECT * FROM commune
          WHERE commune.district_id='".$_POST['id_district']."'
          ";
    $reqs=$db->query($sql);
    $rowCount=$reqs->rowCount();
    if($rowCount>0)
    {
        echo '<option value=""></option>';
        while($row=$reqs->fetch(PDO::FETCH_ASSOC))
        {
            echo '<option value="'.$row['id'].'">'.$row['nom_commune'].'</option>';
        }
    }else
    {
        echo '<option value="">Not available</option>';
    }
}
?>
