<?php
session_start();
require_once 'includes/function.php';
require_once 'includes/db.php';
$Fonction->logged_only();
$Fonction->allow('member');

$sql = "SELECT * FROM nom_pepiniere

    ORDER BY nom_pep ASC ";

$req = $db->query($sql);

?>





<?php
require_once('includes/header.php');
require_once('includes/scripts.php');
require_once('includes/navbar.php');

?>
<div class="container-fluid">
    <div class="card shadow mb-4 mt-4">
        <div class="card-body scrollable" id="acceuil">

            <!-- Button trigger modal -->
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Nouveau
            </button> -->

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nouveau Nom Pépinière</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                        </div>
                        <div class="modal-body">
                           <?php 
                        //    if (isset($_GET['id'])) {
                               
                               $sql_rep="SELECT * FROM nom_pepiniere WHERE id_nompep=1";
                               $req_pep=$db->prepare($sql_rep);
                               $req_pep->execute();
                               $info_pep=$req_pep->fetch();
                         //  }
                           ?>

                           <input type="text" name="" value="<?= $info_pep->nom_pep ?>" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                            <button type="button" class="btn btn-primary">Valider</button>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom Pépinière</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($donnee = $req->fetch()) : ?>
                        <tr>
                            <td><?= $donnee->id_nompep ?></td>
                            <td><?= $donnee->nom_pep ?>></td>
                            <td>
                                <!-- <a href="#" class="btn btn-success btn-sm" style="border-radius: 2em; font-size: xx-small"><span class="fa fa-pen"></span></a> -->
                                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" href="id=<?= $donnee->id_nompep ?>" style="border-radius: 2em; font-size: xx-small">
                                <span class="fa fa-pen"></span>
                                </a>
                                <a href="Fiche_nom_pepiniere.php?del=<?= $donnee->id_nompep ?>" class="btn btn-danger btn-sm" style="border-radius: 2em; font-size: xx-small"><span class="fa fa-trash"></span></a>

                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>


<?php require 'includes/footer.php'; ?>