<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/function.php';
?>

<?php
include('includes/header.php');
include('includes/scripts.php');
include('includes/navbar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="card-body">
                <!-- Carousel
                    ================================================== -->
                    <div id="carouselExampleControlis" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner" style="height: auto;min-height: auto" role="listbox">
                        <div class="carousel-item active">
                          <img class="d-block w-100" src="img/masoala.jpg" alt="First slide">
                          <div class="container">
                            <div class="carousel-caption">
                              <p><a class="btn btn-xs btn-success" href="login.php" role="button" style="box-shadow: 0 5px 15px rgba(0,0,0,.5);background: rgba(255,255,255,.4);"><i class="fas fa-fw fa-search"></i> <span>Connexion</span></a></p>
                            </div>
                          </div>
                        </div>

                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/4000.jpg" alt="Third slide">
                          <div class="container">
                            <div class="carousel-caption">
                              <p><a class="btn btn-xs btn-success" href="login.php" role="button" style="box-shadow: 0 5px 15px rgba(0,0,0,.5);background: rgba(255,255,255,.4);"><i class="fas fa-fw fa-search"></i> <span>Connexion</span></a></p>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/baobab.jpg" alt="Third slide">
                          <div class="container">
                            <div class="carousel-caption">
                              <p><a class="btn btn-xs btn-success" href="login.php" role="button" style="box-shadow: 0 5px 15px rgba(0,0,0,.5);background: rgba(255,255,255,.4);"><i class="fas fa-fw fa-search"></i> <span>Connexion</span></a></p>
                            </div>
                          </div>
                        </div>

                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleControlis" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleControlis" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
  </div>
</div>
  <!-- Content Row -->


<?php
include('includes/footer.php');
?>
