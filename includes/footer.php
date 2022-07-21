<?php
$date=date('Y');

?>

  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="js/sb-admin-2.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</div>
</div>
 </div>       <!-- /.container-fluid -->

      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
           <i class="fas fa-fw fa-home" style="color: white;font-size:large;font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>&nbsp;<span id="art-footnote-links" style="color: white;font-size:medium;font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"><a href="http://102.16.25.129/" target="_blank">Portail MEDD</span></a>&nbsp;
           
           
            <i class="fas fa-fw fa-globe" style="color: white;font-size:large;font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"></i>&nbsp;<span id="art-footnote-links" style="color: white;font-size:medium;font-weight: bold;text-shadow: 1px 0px 2px rgb(0, 0, 0), 1px 0px 2px rgb(0, 0, 0), 0px -1px 2px rgb(0, 0, 0), 0px 1px 2px rgb(0, 0, 0), 0px 0px 12px rgb(0, 0, 0);"><a href="http://www.environnement.mg/" target="_blank">Site Web MEDD</a> / Copyright &copy;<!-- MEDD/DCSI --><?=$date?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
      </div>
      <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
<!-- Custom scripts for all pages-->
 
<script type="text/javascript">
      function population(v1,v2)
      {
        var v1= document.getElementById(v1);
        var v2= document.getElementById(v2);
        v2.innerHTML="";
        if(v1.value=="public")
        {
          var optionArray=["|","terrain domanial|terrain domanial","terrain communal|terrain communal","DFN|DFN","RFR|RFR"];
        }else if(v1.value=="privée")
        {
          var optionArray=["|"];
        }
          for(var option in optionArray)
         {
          var pair=optionArray[option].split("|");
          var newOption=document.createElement("option");
          newOption.value=pair[0];
          newOption.innerHTML=pair[1];
          v2.options.add(newOption);
         }
      }
    </script>
</body>

</html>
