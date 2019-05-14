</div>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->


<script src="<?php echo base_url('theme/vendor/popper.js/umd/popper.min.js');?>"></script>
<script src="<?php echo base_url('theme/vendor/bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('theme/vendor/jquery.cookie/jquery.cookie.js');?>"> </script>
<script src="<?php echo base_url('theme/vendor/chart.js/Chart.min.js');?>"></script>
<script src="<?php echo base_url('theme/vendor/jquery-validation/jquery.validate.min.js');?>"></script>
<style> label.error { color: red; }</style>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script> -->
<!-- Main File-->
<script src="<?php echo base_url('theme/js/front.js');?>"></script>

<script>
  var myIndex = 0;
  carousel();
  function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2000); // Change image every 2 seconds
    }
</script>
 </body>
</html>