<?php include_once("header2.php"); ?>
<style type="text/css">
.contact_form input {
  color:#263555;
   border: 1px solid #d4d0d0;
 padding: 4px 10px 6px;
  width: 100%;
  background-color: #fcfafa;
  /*text-transform: uppercase;*/
  height: 28px;
  float:left;
  font: 13px/18px  Arial, Helvetica, sans-serif;
  box-sizing: border-box;
  -moz-box-sizing: border-box; /*Firefox 1-3*/
  -webkit-box-sizing: border-box; /* Safari */
}

.contact_form textarea {
  color:#263555;
  height: 233px;
  /*text-transform: uppercase;*/
  overflow: auto;
  background-color: #fcfafa;

   border: 1px solid #d4d0d0;
 padding: 15px 10px 6px;
  width: 100%;
  position: relative;
  resize:none;
  box-sizing: border-box;
  -moz-box-sizing: border-box; /*Firefox 1-3*/
  -webkit-box-sizing: border-box; /* Safari */
  float:left;
  font: 13px/18px  Arial, Helvetica, sans-serif;
  margin: 0;
  
}
.contact_form label {
  position:relative;
  display: block;
  min-height: 45px;
  width: 100%;
  float: left;
}  
label.error { color: red; }
</style>
<div class="main">
  <div class="content">
    <div class="container_12">
      <div class="grid_9">
        <h3>Stay in Touch</h3>
        <div class="map">
          <figure class="img_inner fleft">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3399.603050760556!2d74.334231014644!3d31.56250678135568!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39191b35494efe13%3A0x2eb545e9d1140bee!2sThe+Grand+Inn!5e0!3m2!1sen!2s!4v1487872573343" width="100%" height="400px" frameborder="0" style="border:0" allowfullscreen></iframe>
          </figure>
          <address>
          <dl>
            <dt> 9-A, First Floor, Grand Hotel Davis Road, <br>
              Lahore Pakistan. </dt>
            <dd>Phone: 042-36292761,62</dd>
            <dd>E-mail: <a href="mailto:info@toursview.com" class="link-1">info@toursview.com</a></dd>
          </dl>
          </address>
        </div>
      </div>
      <div class="grid_3">
        <h3>Contact Us</h3>
        <form id="contact_form" class="contact_form" action="contact_me.php" method="post">
        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'true' ) { ?>
          <div class="success_wrapper">
            <div class="success">Contact form submitted!<br>
              <strong>We will be in touch soon.</strong> </div>
          </div>
          <?php } ?>
          <fieldset>
            <label class="name">
              <input type="text" name="name" placeholder="Name" placeholder="" class="required">
              <br class="clear">
             </label>
            <label class="email">
              <input type="text" name="email" placeholder="Email" value="" class="required email">
              <br class="clear">
              </label>
            <label class="name">
              <input type="text" name="subject" placeholder="Subject" value="" class="required">
              <br class="clear">
            </label>
            <label class="message">
              <textarea name="message" placeholder="Message" class="required"></textarea>
              <br class="clear">
            </label>
            <div class="clear"></div>
              <div class="none"></div>
              <div class="btns"><button type="submit" class="btn">Send</button></div>
              <div class="clear"></div>
            </div>
          </fieldset>
        </form>
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <?php include_once("footer.php"); ?>