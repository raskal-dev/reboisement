<?php
  if(session_status()==PHP_SESSION_NONE)
  {
    session_start();
  }
require_once "includes/db.php";
require_once "includes/function.php";

if(isset($_POST['reboisement']))
{
    header("location:account.php");
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
    exit();
}

if(isset($_POST['pepiniere']))
{
    header("location:pepiniere.php");
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
    exit();
}

if(isset($_POST['planification']))
{
    header("location:entreedonneesplanification.php");
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
    exit();
}

if(isset($_POST['realisation']))
{
    header("location:entreedonneesrealisation.php");
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
    exit();
}

if(isset($_POST['pepiniereproduction']))
{
    header("location:entreedonneespepiniereproduction.php");
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
    exit();
}

if(isset($_POST['pepinieresortie']))
{
    header("location:entreedonneespepinieresortie.php");
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
    exit();
}

if(isset($_POST['analyse_ap']))
{
    header("location:analyse_ap.php");
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
    exit();
}

if(isset($_POST['analyse_objrpf']))
{
    header("location:analyse_objrpf.php");
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
    exit();
}

if(isset($_POST['analyse_type']))
{
    header("location:analyse_type.php");
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
    exit();
}

if(isset($_POST['analyse_class']))
{
    header("location:analyse_class.php");
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
    exit();
}

if(isset($_POST['analyse_comm']))
{
    header("location:analyse_comm.php");
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
    exit();
}

if(isset($_POST['analyse_parcelle']))
{
    header("location:analyse_parcelle.php");
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
    exit();
}

if(isset($_POST['analyse_situation']))
{
    header("location:analyse_situation.php");
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
    exit();
}

if(isset($_POST['analyse_recap']))
{
    header("location:analyse_recap.php");
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
    exit();
}

if(isset($_POST['discussion']))
{
    header("location:discussionenligne.php");
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
    exit();
}

?>
<style>
body
{
  background: #FFFFFF;
}
  .pagination {
  display: inline-block;
  padding-left: 0;
  margin: 20px 0;
  border-radius: 4px;
}
.pagination > li {
  display: inline;
}
.pagination > li > a,
.pagination > li > span {
  position: relative;
  float: left;
  padding: 6px 12px;
  margin-left: -1px;
  line-height: 1.42857143;
  color: #337ab7;
  text-decoration: none;
  background-color: #fff;
  border: 1px solid #ddd;
}
.pagination > li:first-child > a,
.pagination > li:first-child > span {
  margin-left: 0;
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}
.pagination > li:last-child > a,
.pagination > li:last-child > span {
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px;
}
.pagination > li > a:hover,
.pagination > li > span:hover,
.pagination > li > a:focus,
.pagination > li > span:focus {
  z-index: 2;
  color: #23527c;
  background-color: #eee;
  border-color: #ddd;
}
.pagination > .active > a,
.pagination > .active > span,
.pagination > .active > a:hover,
.pagination > .active > span:hover,
.pagination > .active > a:focus,
.pagination > .active > span:focus {
  z-index: 3;
  color: #fff;
  cursor: default;
  background-color: #337ab7;
  border-color: #337ab7;
}
.pagination > .disabled > span,
.pagination > .disabled > span:hover,
.pagination > .disabled > span:focus,
.pagination > .disabled > a,
.pagination > .disabled > a:hover,
.pagination > .disabled > a:focus {
  color: #777;
  cursor: not-allowed;
  background-color: #fff;
  border-color: #ddd;
}
.pagination-lg > li > a,
.pagination-lg > li > span {
  padding: 10px 16px;
  font-size: 18px;
  line-height: 1.3333333;
}
.pagination-lg > li:first-child > a,
.pagination-lg > li:first-child > span {
  border-top-left-radius: 6px;
  border-bottom-left-radius: 6px;
}
.pagination-lg > li:last-child > a,
.pagination-lg > li:last-child > span {
  border-top-right-radius: 6px;
  border-bottom-right-radius: 6px;
}
.pagination-sm > li > a,
.pagination-sm > li > span {
  padding: 5px 10px;
  font-size: 12px;
  line-height: 1.5;
}
.pagination-sm > li:first-child > a,
.pagination-sm > li:first-child > span {
  border-top-left-radius: 3px;
  border-bottom-left-radius: 3px;
}
.pagination-sm > li:last-child > a,
.pagination-sm > li:last-child > span {
  border-top-right-radius: 3px;
  border-bottom-right-radius: 3px;
}
.scrollable{height: auto;overflow-x: auto;overflow-y: auto;font-size: smaller;width: inherit}
.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 20px;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: 1px solid #ddd;
}
.table > thead > tr > th {
  vertical-align: bottom;
  border-bottom: 2px solid #ddd;
}
.table > caption + thead > tr:first-child > th,
.table > colgroup + thead > tr:first-child > th,
.table > thead:first-child > tr:first-child > th,
.table > caption + thead > tr:first-child > td,
.table > colgroup + thead > tr:first-child > td,
.table > thead:first-child > tr:first-child > td {
  border-top: 0;
}
.table > tbody + tbody {
  border-top: 2px solid #ddd;
}
.table .table {
  background-color: #fff;
}
.table-condensed > thead > tr > th,
.table-condensed > tbody > tr > th,
.table-condensed > tfoot > tr > th,
.table-condensed > thead > tr > td,
.table-condensed > tbody > tr > td,
.table-condensed > tfoot > tr > td {
  padding: 5px;
}
.table-bordered {
  border: 1px solid #ddd;
}
.table-bordered > thead > tr > th,
.table-bordered > tbody > tr > th,
.table-bordered > tfoot > tr > th,
.table-bordered > thead > tr > td,
.table-bordered > tbody > tr > td,
.table-bordered > tfoot > tr > td {
  border: 1px solid #ddd;
}
.table-bordered > thead > tr > th,
.table-bordered > thead > tr > td {
  border-bottom-width: 2px;
}
.table-striped > tbody > tr:nth-of-type(odd) {
  background-color: #f9f9f9;
}
.table-hover > tbody > tr:hover {
  background-color: #f5f5f5;
}
table col[class*="col-"] {
  position: static;
  display: table-column;
  float: none;
}
table td[class*="col-"],
table th[class*="col-"] {
  position: static;
  display: table-cell;
  float: none;
}
.table > thead > tr > td.active,
.table > tbody > tr > td.active,
.table > tfoot > tr > td.active,
.table > thead > tr > th.active,
.table > tbody > tr > th.active,
.table > tfoot > tr > th.active,
.table > thead > tr.active > td,
.table > tbody > tr.active > td,
.table > tfoot > tr.active > td,
.table > thead > tr.active > th,
.table > tbody > tr.active > th,
.table > tfoot > tr.active > th {
  background-color: #f5f5f5;
}
.table-hover > tbody > tr > td.active:hover,
.table-hover > tbody > tr > th.active:hover,
.table-hover > tbody > tr.active:hover > td,
.table-hover > tbody > tr:hover > .active,
.table-hover > tbody > tr.active:hover > th {
  background-color: #e8e8e8;
}
.table > thead > tr > td.success,
.table > tbody > tr > td.success,
.table > tfoot > tr > td.success,
.table > thead > tr > th.success,
.table > tbody > tr > th.success,
.table > tfoot > tr > th.success,
.table > thead > tr.success > td,
.table > tbody > tr.success > td,
.table > tfoot > tr.success > td,
.table > thead > tr.success > th,
.table > tbody > tr.success > th,
.table > tfoot > tr.success > th {
  background-color: #dff0d8;
}
.table-hover > tbody > tr > td.success:hover,
.table-hover > tbody > tr > th.success:hover,
.table-hover > tbody > tr.success:hover > td,
.table-hover > tbody > tr:hover > .success,
.table-hover > tbody > tr.success:hover > th {
  background-color: #d0e9c6;
}
.table > thead > tr > td.info,
.table > tbody > tr > td.info,
.table > tfoot > tr > td.info,
.table > thead > tr > th.info,
.table > tbody > tr > th.info,
.table > tfoot > tr > th.info,
.table > thead > tr.info > td,
.table > tbody > tr.info > td,
.table > tfoot > tr.info > td,
.table > thead > tr.info > th,
.table > tbody > tr.info > th,
.table > tfoot > tr.info > th {
  background-color: #d9edf7;
}
.table-hover > tbody > tr > td.info:hover,
.table-hover > tbody > tr > th.info:hover,
.table-hover > tbody > tr.info:hover > td,
.table-hover > tbody > tr:hover > .info,
.table-hover > tbody > tr.info:hover > th {
  background-color: #c4e3f3;
}
.table > thead > tr > td.warning,
.table > tbody > tr > td.warning,
.table > tfoot > tr > td.warning,
.table > thead > tr > th.warning,
.table > tbody > tr > th.warning,
.table > tfoot > tr > th.warning,
.table > thead > tr.warning > td,
.table > tbody > tr.warning > td,
.table > tfoot > tr.warning > td,
.table > thead > tr.warning > th,
.table > tbody > tr.warning > th,
.table > tfoot > tr.warning > th {
  background-color: #fcf8e3;
}
.table-hover > tbody > tr > td.warning:hover,
.table-hover > tbody > tr > th.warning:hover,
.table-hover > tbody > tr.warning:hover > td,
.table-hover > tbody > tr:hover > .warning,
.table-hover > tbody > tr.warning:hover > th {
  background-color: #faf2cc;
}
.table > thead > tr > td.danger,
.table > tbody > tr > td.danger,
.table > tfoot > tr > td.danger,
.table > thead > tr > th.danger,
.table > tbody > tr > th.danger,
.table > tfoot > tr > th.danger,
.table > thead > tr.danger > td,
.table > tbody > tr.danger > td,
.table > tfoot > tr.danger > td,
.table > thead > tr.danger > th,
.table > tbody > tr.danger > th,
.table > tfoot > tr.danger > th {
  background-color: #f2dede;
}
.table-hover > tbody > tr > td.danger:hover,
.table-hover > tbody > tr > th.danger:hover,
.table-hover > tbody > tr.danger:hover > td,
.table-hover > tbody > tr:hover > .danger,
.table-hover > tbody > tr.danger:hover > th {
  background-color: #ebcccc;
}
.table-responsive {
  min-height: .01%;
  overflow-x: auto;
}
@media screen and (max-width: 767px) {
  .table-responsive {
    width: 100%;
    margin-bottom: 15px;
    overflow-y: hidden;
    -ms-overflow-style: -ms-autohiding-scrollbar;
    border: 1px solid #ddd;
  }
  .table-responsive > .table {
    margin-bottom: 0;
  }
  .table-responsive > .table > thead > tr > th,
  .table-responsive > .table > tbody > tr > th,
  .table-responsive > .table > tfoot > tr > th,
  .table-responsive > .table > thead > tr > td,
  .table-responsive > .table > tbody > tr > td,
  .table-responsive > .table > tfoot > tr > td {
    white-space: nowrap;
  }
  .table-responsive > .table-bordered {
    border: 0;
  }
  .table-responsive > .table-bordered > thead > tr > th:first-child,
  .table-responsive > .table-bordered > tbody > tr > th:first-child,
  .table-responsive > .table-bordered > tfoot > tr > th:first-child,
  .table-responsive > .table-bordered > thead > tr > td:first-child,
  .table-responsive > .table-bordered > tbody > tr > td:first-child,
  .table-responsive > .table-bordered > tfoot > tr > td:first-child {
    border-left: 0;
  }
  .table-responsive > .table-bordered > thead > tr > th:last-child,
  .table-responsive > .table-bordered > tbody > tr > th:last-child,
  .table-responsive > .table-bordered > tfoot > tr > th:last-child,
  .table-responsive > .table-bordered > thead > tr > td:last-child,
  .table-responsive > .table-bordered > tbody > tr > td:last-child,
  .table-responsive > .table-bordered > tfoot > tr > td:last-child {
    border-right: 0;
  }
  .table-responsive > .table-bordered > tbody > tr:last-child > th,
  .table-responsive > .table-bordered > tfoot > tr:last-child > th,
  .table-responsive > .table-bordered > tbody > tr:last-child > td,
  .table-responsive > .table-bordered > tfoot > tr:last-child > td {
    border-bottom: 0;
  }
  .scrollable{height: 300px;overflow-x: auto;overflow-y: auto}
}
.navbar{
  margin:10px auto 0;
  width: 100%;
  height: 40px;
  background-image: url('img/test10.jpg');
}
.sidebar{
  margin-left:25px;
  background-image: url('img/test10.jpg');
}

.art-headline,
.art-headline a,
.art-headline a:link,
.art-headline a:visited,
.art-headline a:hover
{
font-size: 16px;
font-family: 'Comic Sans MS', Tahoma, Arial, Sans-Serif;
font-weight: bold;
font-style: normal;
text-decoration: none;
text-align: left;
text-shadow: 1px 0px 2px rgb(9, 120, 179), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(9, 120, 179), 0px 1px 2px rgb(9, 120, 179), 0px 0px 12px rgb(9, 120, 179);
  padding: 0;
  margin: 0;
  color: #FCFDFD !important;
  white-space: nowrap;
  margin: 4em;
}
  </style>

 <body id="page-top">


    <div id="carouselExampleControls" class="carousel slide mr-4 ml-4" data-ride="carousel" style="border-radius: 1em">
                  <div class="carousel-inner" style="border-radius: 1em">
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="img/test1.png" alt="First slide" style="border-radius: 1em">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="img/test2.png" alt="Second slide" style="border-radius: 1em">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="img/test1.png" alt="Third slide" style="border-radius: 1em">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="img/test2.png" alt="Second slide" style="border-radius: 1em">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>

    <a href="#" class="art-headline ml-auto">« REBOISEMENT »</a>
  </div>





    <!-- Content Wrapper -->
    <div id="wrapper">

      <!-- Main Content -->

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow display-flex justify-content-between mb-4 ml-4 mr-4" style="border-radius: 0.5em">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <marquee scrollamount="3"><span class="art-headline">« REBOISEMENT »</span></marquee>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>
            <?php if(isset($_SESSION['authentifier'])):?>
              <li class="nav-item dropdown no-arrow"><a class="nav-link dropdown-toggle" style="color: white">(<?= $_SESSION['authentifier']['nom_diredd_dredd_ciredd'] ?>)</a></li>
            <?php endif;?>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                <?php if(isset($_SESSION['authentifier']) && $_SESSION['authentifier']['level']>="1"):?>
                  <b><mark><?php echo $_SESSION['authentifier']['identifiant'] ?>&nbsp;<sup>(&nbsp;<?php echo $_SESSION['authentifier']['name'] ?>&nbsp;)</sup></mark></b>
                <?php endif;?>
                </span>
                <?php if(isset($_SESSION['authentifier']) && $_SESSION['authentifier']['level']>="1"):?>
                  <div class="create-post-profile-owner-picture-container">
                    <img src="public/assets/images/icons/user.png" class="img-profile rounded-circle" alt="">
                  </div>
                <?php endif;?>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <?php if(isset($_SESSION['authentifier'])):?>
                  <a class="dropdown-item" href="admin.php">
                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                      Profile
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Déconnexion
                  </a>
                <?php endif;?>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
    </div>

   <!-- Sidebar -->
   <div id="wrapper">

   <ul class="navbar-nav bg-gradient-success sidebar sidebar-white accordion" id="accordionSidebar" style="border-radius: 1em">

<!-- Sidebar - Brand -->
<!-- Divider -->
<hr class="sidebar-divider my-0">


<!-- Divider -->
<hr class="sidebar-divider">

<?php if(isset($_SESSION['authentifier'])):?>
<form action="" method="post">


<li class="nav-item active">
  <a class="nav-link" href="accueil.php" style="color: #F2EAEA;">
    <i class="fas fa-fw fa-home" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>
    <span style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">Accueil</span></a>
</li>

<li class="nav-item active">
  <a class="nav-link" href="analyseReb.php" style="color: #F2EAEA;">
    <i class="fa fa-fw fa-tachometer-alt" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>
    <span style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">Analyse</span></a>
</li>

<!-- Nav Item - Dashboard -->
<!--
<li class="nav-item active">
  <a class="nav-link" href="accueil.php" style="color: #F2EAEA;">
    <i class="fas fa-fw fa-home" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>
    <span style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">Accueil</span></a>
</li>-->

<!-- Divider
<hr class="sidebar-divider">
 -->
<!-- Heading
<div class="sidebar-heading" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">
  Analyse
</div>
 -->
<!-- Nav Item
<li class="nav-item active">
    <button type="submit" name="analyse_ap" class="nav-link btn btn-sm" data-toggle="tooltip" data-placement="left" title="Inserer nouvelles données" style="color: #F2EAEA;">
    <i class="fas fa-fw fa-search" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>
    <span style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">AP</span></button>
</li>
 -->
<!-- Nav Item
<li class="nav-item active">
    <button type="submit" name="analyse_objrpf" class="nav-link btn btn-sm" data-toggle="tooltip" data-placement="left" title="Inserer nouvelles données Pépinières" style="color: #F2EAEA;">
    <i class="fas fa-fw fa-search" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>
    <span style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">Objectif RPF</span></button>
</li>
 -->
<!-- Nav Item
<li class="nav-item active">
    <button type="submit" name="analyse_type" class="nav-link btn btn-sm" data-toggle="tooltip" data-placement="left" title="Inserer nouvelles données Pépinières" style="color: #F2EAEA;">
    <i class="fas fa-fw fa-search" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>
    <span style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">Type Acteur</span></button>
</li>
 -->
<!-- Nav Item
<li class="nav-item active">
    <button type="submit" name="analyse_class" class="nav-link btn btn-sm" data-toggle="tooltip" data-placement="left" title="Inserer nouvelles données Pépinières" style="color: #F2EAEA;">
    <i class="fas fa-fw fa-search" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>
    <span style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">Classe</span></button>
</li>
 -->
<!-- Nav Item
<li class="nav-item active">
    <button type="submit" name="analyse_comm" class="nav-link btn btn-sm" data-toggle="tooltip" data-placement="left" title="Inserer nouvelles données Pépinières" style="color: #F2EAEA;">
    <i class="fas fa-fw fa-search" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>
    <span style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">Commune reboisée</span></button>
</li>
 -->
<!-- Nav Item
<li class="nav-item active">
    <button type="submit" name="analyse_parcelle" class="nav-link btn btn-sm" data-toggle="tooltip" data-placement="left" title="Inserer nouvelles données Pépinières" style="color: #F2EAEA;">
    <i class="fas fa-fw fa-search" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>
    <span style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">Nombre parcelle</span></button>
</li>
 -->
<!-- Nav Item -
<li class="nav-item active">
    <button type="submit" name="analyse_situation" class="nav-link btn btn-sm" data-toggle="tooltip" data-placement="left" title="Inserer nouvelles données Pépinières" style="color: #F2EAEA;">
    <i class="fas fa-fw fa-search" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>
    <span style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">Situation</span></button>
</li>
 -->
<!-- Nav Item -
<li class="nav-item active">
    <button type="submit" name="analyse_recap" class="nav-link btn btn-sm" data-toggle="tooltip" data-placement="left" title="Inserer nouvelles données Pépinières" style="color: #F2EAEA;">
    <i class="fas fa-fw fa-search" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>
    <span style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">Récap par DREDD</span></button>
</li>
-->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">
  Insertion
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item active">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseImpor" aria-expanded="true" aria-controls="collapseImpor" style="color: #F2EAEA;">

    <i class="fas fa-fw fa-info" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>
    <span style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">Enregistrement</span>
  </a>
  <div id="collapseImpor" class="collapse" aria-labelledby="headingImpor" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <button class="collapse-item active btn btn-sm" name="reboisement" style="color: #353030;">Reboisement</button>
      <button class="collapse-item active btn btn-sm" name="pepiniere" style="color: #353030;">Pépinières</button>
    </div>
  </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item active">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseImpors" aria-expanded="true" aria-controls="collapseImpors" style="color: #F2EAEA;">

    <i class="fas fa-fw fa-info" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>
    <span style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">Formulaire kobo</span>
  </a>
  <div id="collapseImpors" class="collapse" aria-labelledby="headingImpors" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <button class="collapse-item active btn btn-sm" name="planification" style="color: #353030;">Planification</button>
      <button class="collapse-item active btn btn-sm" name="realisation" style="color: #353030;">Réalisation</button>
      <button class="collapse-item active btn btn-sm" name="pepiniereproduction" style="color: #353030;">Pépinière production</button>
      <button class="collapse-item active btn btn-sm" name="pepinieresortie" style="color: #353030;">Pépinière sortie</button>
    </div>
  </div>
</li>



<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">
  Discussion en ligne
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item active">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseImport" aria-expanded="true" aria-controls="collapseImport" style="color: #F2EAEA;">

    <i class="fas fa-fw fa-comments" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>
    <span style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></span>
  </a>
  <div id="collapseImport" class="collapse" aria-labelledby="headingImport" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <button class="collapse-item active btn btn-sm" name="discussion" style="color: #353030;">Discussion</button>
    </div>
  </div>
</li>

</form>
<?php else:?>
<!-- Divider -->
<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="index.php" style="color: #F2EAEA;">
    <i class="fas fa-fw fa-home" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>
    <span style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">Accueil</span></a>
</li>

<hr class="sidebar-divider">

<li class="nav-item active">
  <a class="nav-link" href="carteInteractive.php" style="color: #F2EAEA;">
    <i class="fas fa-fw fa-map" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>
    <span style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">Carte intéractive</span></a>
</li>


<hr class="sidebar-divider">

<li class="nav-item active">
  <a class="nav-link" href="apropos.php" style="color: #F2EAEA;">
    <i class="fas fa-fw fa-info-circle" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>
    <span style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">A propos </span></a>
</li>

<hr class="sidebar-divider">

<!-- Nav Item - Tables -->
<li class="nav-item active">
  <a class="nav-link" href="login.php" style="color: #F2EAEA;">
    <i class="fas fa-fw fa-sign-in-alt" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>
    <span style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">Connexion</span></a>
</li>
<!-- Divider -->
<hr class="sidebar-divider">

<!--
<li class="nav-item active">
  <a class="nav-link" href="register.php" style="color: #F2EAEA;">
    <i class="fas fa-fw fa-sign-out-alt" style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>
    <span style="font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);">Inscription</span></a>
</li>


<?php endif;?>
<hr class="sidebar-divider d-none d-md-block">
<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->


<div id="content-wrapper" >
 <!-- Main Content -->
 <div id="content">
<!--

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Se déconnecter?</h5>
          <button class="Annuler" type="button" data-dismiss="modal" aria-label="Annuler">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Êtes vous sûre de vouloir vous déconnecté?</div>
        <div class="modal-footer">


          <form action="logout.php" method="POST">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
            <button type="submit" name="logout_btn" class="btn btn-success">Déconnexion</button>

          </form>


        </div>
      </div>
    </div>
  </div>

  <div class="container">
				<?php if(isset($_SESSION['flash'])):?>
					<?php foreach($_SESSION['flash'] as $type=>$message):?>
						<div class="col-sm-12 alert alert-<?= $type;?>" id="messageFlash">
							<span class="glyphicon glyphicon-log-in"></span> <?= $message;?>
						</div>

					<?php endforeach;?>
					<?php unset($_SESSION['flash']);?>
				<?php endif;?>
			</div>
