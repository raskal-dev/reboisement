<?php
require_once 'includes/function.php';
require_once 'includes/db.php';
require_once 'connexion.php';
$Fonction->logged_only();
$Fonction->allow('member');

$sql = "SELECT * FROM nom_pepiniere

    ORDER BY id_nompep ASC ";

$req = $db->query($sql);

?>





<?php
require_once('includes/header.php');
require_once('includes/scripts.php');
require_once('includes/navbar.php');

?>

<!-- collaps -->

<?php
if (isset($_SESSION['message'])) : ?>
    <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>

    </div>

<?php endif ?>
<p></p>
<main class="container">
    <div class="card shadow mb-4">

        <?php
        if ($update == true) :
        ?>

        <?php else : ?>
            <button class="btn btn-success" title="Nouveau nom pépinière" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <span class="fa fa-plus"></span>
            </button>
        <?php endif; ?>

        <?php
        if ($update == true) :
        ?>
            <div class="collapse show" id="collapseExample">
            <?php else : ?>
                <div class="collapse" id="collapseExample">
                <?php endif; ?>

                <div class="card card-body">
                    <div class="row justify-content-center">
                        <section class="col-3">
                            <form class="row g-4 was-validated" action="connexion.php" method="POST">
                                <input type="hidden" maxlength="4" name="id_nompep" value="<?php echo $id_nompep; ?>">
                                <div class="form-floating mb-3">
                                    <label for="nom_pep">(*)Nom Pépinière</label>
                                    <input type="text" name="nom_pep" value="<?php echo $nom_pep; ?>" id="nom_pep" class="form-control" placeholder="Entrez le nom du pépinière" required>
                                    <div class="invalid-feedback">le nom est incorrect</div>
                                    <div class="valid-feedback">le nom est correct</div>
                                </div>

                                <div class="form-floating mb-3">
                                    <div class="form-group">
                                        <?php
                                        if ($update == true) :
                                        ?>
                                            <button type="submit" class="btn btn-primary" name="update" onclick="return(confirm('Etes-vous sûr de vouloir confirmer la commande'));">Modifier</button>
                                            <a href="Fiche_nom_pepiniere.php" type="submit" class="btn btn-danger">Annuler</a>
                                        <?php else : ?>
                                            <button type="submit" class="btn btn-primary" name="save" onclick="return(confirm('Etes-vous sûr de vouloir confirmer la commande'));">Ajouter</button>
                                        <?php endif; ?>
                                    </div>
                                </div>


                            </form>
                        </section>
                    </div>
                </div>
                </div>
                <?php
                $mysqli = new mysqli('localhost', 'root', '', 'reboisement') or die(mysqli_error($mysqli));
                $result = $mysqli->query("SELECT * FROM nom_pepiniere ORDER BY id_nompep DESC") or die($mysqli->error);
                ?>

                <h2 class=" text-primary text-center " style="margin-top: 40px; ">Liste des Pépinière</h2>
                <div class="row">
                    <table class="table">
                        <thead class="bg-dark text-light text-center">
                            <tr>
                                <th>N°</th>
                                <th>Nom Pépinière</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            while ($row = $result->fetch_assoc()) : ?>
                                <tr>
                                    <td><?php echo $row['id_nompep']; ?></td>
                                    <td><?php echo $row['nom_pep']; ?></td>
                                    <td>
                                        <a href="Fiche_nom_pepiniere.php?edit=<?php echo $row['id_nompep']; ?>" class="badge badge-pill badge-success">Modifier</a>
                                        <a href="connexion.php?delete=<?php echo $row['id_nompep']; ?>" class="badge badge-pill badge-danger" onclick="return(confirm('Etes-vous sûr de vouloir confirmer la commande'));">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <?php
                function pre_r($array)
                {
                    echo '<pre>';
                    print_r($array);
                    echo '</pre>';
                }

                ?>
            </div>
</main>







<?php require 'includes/footer.php'; ?>