<div class="clear"></div>
<div class="bottom_block">
    <div class="container_12">
      <div class="grid_3 prefix_3" style="padding-left: 0; padding-top: 41px; margin-left: 0px;">
        <img src="images/bottom_logo.png" alt="Unique Solutions">
      </div>
      <div class="grid_2 prefix_2" style="padding-left: 0; padding-top: 27px; margin-left: 0px;">
        <img src="images/unique_solution.png" alt="Unique Solutions">
      </div>
      <div class="grid_2">
        <div class="grid_2 prefix_2" style="padding-left: 0; padding-top: 11px;">
        <img width="350" height="94" src="images/sabre.png" alt="sabre">
      </div>
      </div>
      <div class="grid_3" style="float: right;">
        <div class="grid_3 prefix_3" style="padding-left: 0; padding-top: 27px;">
        <img width="345" height="80" src="images/unique_product.png" alt="Unique Solutions">
      </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<footer>
  <div class="container_12">
    <div class="grid_12">
      <div class="socials"> <a href="#"></a> <a href="#"></a> <a href="#"></a> <a href="#"></a> </div>
      <div class="copy"> Tours View &copy; <?php echo date("Y"); ?> </div>
    </div>
    <div class="clear"></div>
  </div>
</footer>
<script src="js/jquery.js"></script>
<script src="js/jquery-migrate-1.1.1.js"></script>
<script src="js/superfish.js"></script>
<script src="js/sForm.js"></script>
<!-- <script src="js/forms.js"></script> -->
<script src="js/jquery.jqtransform.js"></script>
<script src="js/jquery.equalheights.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/tms-0.4.1.js"></script>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/jquery.ui.totop.js"></script>
<script src="dist/js/jquery.validate.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#contact_form").validate();
  });
</script>
  <!-- <script src="js/lightbox-plus-jquery.min.js"></script> -->
<script>
$(window).load(function () {
    $('.slider')._TMS({
        show: 0,
        pauseOnHover: false,
        prevBu: '.prev',
        nextBu: '.next',
        playBu: false,
        duration: 800,
        preset: 'random',
        pagination: false, //'.pagination',true,'<ul></ul>'
        pagNums: false,
        slideshow: 8000,
        numStatus: false,
        banners: true,
        waitBannerAnimation: false,
        progressBar: false
    });
    $("#tabs").tabs();
    $().UItoTop({
        easingType: 'easeOutQuart'
    });
});
</script>
<script>
$(window).load(function () {
    $().UItoTop({
        easingType: 'easeOutQuart'
    });
});
$(function () {
    $('.gallery a.gal').touchTouch();
});
</script>
</body>
</html>