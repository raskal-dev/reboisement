

 <?php
  ob_start();
  
?>

<section class="tabs content18 cid-t64usfrEKz" id="tabs1-1k">

        <div class="row justify-content-center">
            <div class="col-12 col-md-12">
                <h3 class="mbr-section-title mb-0 mbr-fonts-style display-5">
                    <strong>Analayse des données</strong></h3>
                
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-12 col-md-12">
                <ul class="nav nav-tabs mb-4" role="tablist">
                    <li class="nav-item first mbr-fonts-style">
                      <a class="nav-link mbr-fonts-style show active display-7" role="tab" data-toggle="tab" href="#tabs1-1k_tab0" aria-selected="true"><strong>Campagne en cours</strong></a>
                    </li>
                    <li class="nav-item"><a class="nav-link mbr-fonts-style active display-7" role="tab" data-toggle="tab" href="#tabs1-1k_tab1" aria-selected="true"><strong>Historique</strong></a>
                    </li>
                    
                    
                </ul>
                <div class="tab-content">
                    <div id="tab1" class="tab-pane in active" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="mbr-text mbr-fonts-style display-7"></p>
                               
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane display-7" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="mbr-text mbr-fonts-style display-7"></p>
                              
                            </div>
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

