

 <?php
  ob_start();
  
?>

<section class="tabs content18 cid-t64usfrEKz" id="tabs1-1k">

       <iframe src="<?php echo base_url();?>index.php/activite.php/pepiniereProduction?tableName=pepiniere" class="fram"></iframe>
   
</section>

  
<?php
  include 'login.php';
  include 'register.php';
  $content = ob_get_clean();
  include 'baseLayout.php';
?>
<style type="text/css">
    .fram{
        height: 450px;
        width: 100%;
        border: none;
        scrolling : no;
        overflow: hidden;

    }
</style>

