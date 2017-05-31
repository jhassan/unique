<?php include_once("header2.php"); ?>
<style type="text/css">

label.error { color: red; }
.file_h3 {
  padding-top: 0px !important;
  margin-bottom: 0px !important;
  font-size: 20px !important;
}
.file_p{
  font-weight: bold;
}
</style>
<div class="main">
  <div class="content">
    <div class="container_12">
        <h3>Apply Online</h3>
        <form id="contact_form" class="contact_form" action="" method="post">
          <fieldset>
            <label class="name grid_4" style="margin-left: 0px;">
              <input type="text" name="owner_name" placeholder="Owner Name" class="required">
              <br class="clear">
             </label>
            <label class="email grid_4">
              <input type="text" name="company_name" placeholder="Company Name" value="" class="required">
              <br class="clear">
              </label>
            <label class="name grid_4">
              <input type="text" name="cnic" placeholder="CNIC" value="" class="required">
              <br class="clear">
            </label>
            <label class="name grid_4" style="margin-left: 0px;">
              <input type="text" name="city" placeholder="City" value="" class="required">
              <br class="clear">
            </label>
            <label class="name grid_4">
              <input type="text" name="address" placeholder="Address" value="" class="required">
              <br class="clear">
            </label>
            <label class="name grid_4">
              <input type="text" name="office_no" placeholder="Office #" value="" class="required">
              <br class="clear">
            </label>
            <label class="name grid_4" style="margin-left: 0px;">
              <input type="text" name="cell_no" placeholder="Cell #" value="" class="required">
              <br class="clear">
            </label>
            <div class="clear"></div>
            <label class="name grid_4" style="margin-left: 0px;">
              <h3 class="file_h3">Please attach all files</h3>
            </label>
            <div class="clear"></div>
            <label class="name grid_4" style="margin-left: 0px;">
              <p class="file_p">DTS License Copy</p>
              <input type="file" name="dts_license_copy" value="" class="required">
              <br class="clear">
            </label>
            <label class="name grid_4">
              <p class="file_p">DTS Bank Guarantee Copy</p>
              <input type="file" name="dts_bank_copy" value="" class="required">
              <br class="clear">
            </label>
            <label class="name grid_4">
              <p class="file_p">NTN Certificate Copy</p>
              <input type="file" name="ntn_certificate_copy" value="" class="required">
              <br class="clear">
            </label>
            <div class="clear"></div>
              <div class="none"></div>
              <div class="btns fleft"><button type="submit" class="btn">Send</button></div>
              <div class="clear"></div>
          </fieldset>
        </form>
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <?php include_once("footer.php"); ?>