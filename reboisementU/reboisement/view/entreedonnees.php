

 <?php
  ob_start();
  
?>

<section class="tabs content18 cid-t64usfrEKz" id="tabs1-1k">

        <div class="row justify-content-center">
            <div class="col-12 col-md-12">
                <h3 class="mbr-section-title mb-0 mbr-fonts-style display-5">
                    <strong>Plantation</strong></h3>
                
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-12 col-md-12">
                <ul class="nav nav-tabs mb-4" role="tablist">
                    <li class="nav-item first mbr-fonts-style">
                      <a class="nav-link mbr-fonts-style show active display-7" role="tab" data-toggle="tab" href="#tabs1-1k_tab0" aria-selected="true"><strong>Plantation</strong></a>
                    </li>
                    <li class="nav-item"><a class="nav-link mbr-fonts-style active display-7" role="tab" data-toggle="tab" href="#tabs1-1k_tab1" aria-selected="true"><strong>Fiche technique</strong></a>
                    </li>
                    <li class="nav-item"><a class="nav-link mbr-fonts-style active display-7" role="tab" data-toggle="tab" href="#tabs1-1k_tab2" aria-selected="true"><strong>Lutte active contre le feu</strong></a>
                    </li>
                    <li class="nav-item"><a class="nav-link mbr-fonts-style active display-7" role="tab" data-toggle="tab" href="#tabs1-1k_tab3" aria-selected="true"><strong>Planification annuelle</strong></a>
                    </li>
                    <li class="nav-item"><a class="nav-link mbr-fonts-style active display-7" role="tab" data-toggle="tab" href="#tabs1-1k_tab4" aria-selected="true"><strong>Taux de réussite</strong></a>
                    </li>
                    
                </ul>
                <div class="tab-content">
                    <div id="tab1" class="tab-pane in active" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="mbr-text mbr-fonts-style display-7"></p>
                                <iframe src="<?php echo base_url();?>index.php/activite.php/plantation" class="fram"></iframe>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane display-7" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="mbr-text mbr-fonts-style display-7"></p>
                                <iframe src="<?php echo base_url();?>index.php/activite.php/plantationFicheTechnique?idPlantation=*" class="fram"></iframe>
                            </div>
                        </div>
                    </div>
                    <div id="tab3" class="tab-pane" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="mbr-text mbr-fonts-style display-7"></p>
                                <iframe src="<?php echo base_url();?>index.php/activite.php/suiviActiveFeu" class="fram"></iframe>
                            </div>
                        </div>
                    </div>
                    <div id="tab4" class="tab-pane" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="mbr-text mbr-fonts-style display-7"></p>
                                <iframe src="<?php echo base_url();?>index.php/activite.php/planificationAnnuelle" class="fram"></iframe>
                            </div>
                        </div>
                    </div>
                    <div id="tab5" class="tab-pane" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="mbr-text mbr-fonts-style display-7"></p>
                                <iframe src="<?php echo base_url();?>index.php/activite.php/suiviDensiteReussite" class="fram"></iframe>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
   
</section>

  
<?php
  include 'login.php';
  include 'register.php';
  $content = ob_get_clean();
  include 'baseLayout.php';
?>
<style type="text/css">
    .fram{
        height: 950px;
        width: 100%;
        border: none;
        scrolling : no;
        overflow: hidden;

    }
</style>

