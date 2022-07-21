<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/adminlte.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/web/assets/mobirise-icons2/mobirise2.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/tether/tether.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap-grid.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap-reboot.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/dropdown/css/style.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/socicon/css/styles.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/theme/css/style.css">
<link rel="preload" as="style" href="<?php echo base_url();?>assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="<?php echo base_url();?>assets/mobirise/css/mbr-additional.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/leaflet.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
<?php 

function base_url(){
    $url = 'http://102.16.25.129/reboisement/reboisementU/reboisement/';
    return $url;
  }

?>


<section class="tabs content18 cid-t64usfrEKz" id="tabs1-1k">

        <div class="row justify-content-center">
            <div class="col-12 col-md-12">
                <h3 class="mbr-section-title mb-0 mbr-fonts-style display-5">
                    <strong>Discussion en ligne</strong></h3>
                
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-12 col-md-12">
                <ul class="nav nav-tabs mb-4" role="tablist">
                    <li class="nav-item first mbr-fonts-style">
                      <a class="nav-link mbr-fonts-style show active display-7" role="tab" data-toggle="tab" href="#tabs1-1k_tab0" aria-selected="true"><strong>Discussion</strong></a>
                    </li>
                    <li class="nav-item"><a class="nav-link mbr-fonts-style active display-7" role="tab" data-toggle="tab" href="#tabs1-1k_tab1" aria-selected="true"><strong>Sujet de discussion</strong></a>
                    </li>
                   
                    
                </ul>
                <div class="tab-content">
                    <div id="tab1" class="tab-pane in active" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="mbr-text mbr-fonts-style display-7"></p>
                                <iframe src="/reboisement/reboisementU/reboisement/view/chat.php" class="fram"></iframe>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane display-7" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="mbr-text mbr-fonts-style display-7"></p>
                                <iframe src="/reboisement/reboisementU/reboisement/view/gestionChat.php?tableName=sujet_discussion" class="fram"></iframe>
                            </div>
                        </div>
                    </div>
             
                    
                </div>
            </div>
        </div>
   
</section>

  

<style type="text/css">
    .fram{
        height: 950px;
        width: 100%;
        border: none;
        scrolling : no;
        overflow: hidden;

    }
</style>

<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.checkboxes.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.css">

<script src="<?php echo base_url();?>assets/js/dataTables.select.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/reboisement.css">


<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- ChartJS -->
<script src="<?php echo base_url();?>assets/plugins/chart.js/Chart.min.js"></script>
 <script src="<?php echo base_url();?>assets/popper/popper.min.js"></script>
 <script src="<?php echo base_url();?>assets/tether/tether.min.js"></script>
 <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
 <script src="<?php echo base_url();?>assets/smoothscroll/smooth-scroll.js"></script>
 <script src="<?php echo base_url();?>assets/dropdown/js/nav-dropdown.js"></script>
 <script src="<?php echo base_url();?>assets/dropdown/js/navbar-dropdown.js"></script>
 <script src="<?php echo base_url();?>assets/touchswipe/jquery.touch-swipe.min.js"></script>
 <script src="<?php echo base_url();?>assets/theme/js/script.js"></script>
<script src="<?php echo base_url();?>assets/js/leaflet.js"></script>
<script src="<?php echo base_url();?>assets/js/leaflet.shpfile.js"></script>
<script src="<?php echo base_url();?>assets/js/shp.js"></script>


