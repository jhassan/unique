<?php if(empty($GetID)){ ?>
                  <div class="form-group m-l-20 m-t-15">
                    <label>Admin/Client</label>
                    <label class="radio-inline">
                      <input type="radio" value="1" name="user_type">
                      Admin </label>
                    <label class="radio-inline">
                      <input type="radio" checked="" value="0" name="user_type">
                      Client </label>
                  </div>
                  <?php } else { 

											if($UserType == '1')

												$CheckedAdmin = "checked=''";

											else

												$CheckedAdmin = "";

												

											if($UserType == '0')

												$CheckedClient = "checked=''";

											else

												$CheckedClient = "";		

										?>
                  <div class="form-group m-l-20 m-t-15">
                    <label>Admin/Client</label>
                    <label class="radio-inline">
                      <input type="radio" <?php echo $CheckedAdmin;?> value="1" name="user_type">
                      Admin </label>
                    <label class="radio-inline">
                      <input type="radio" <?php echo $CheckedClient;?> value="0" name="user_type">
                      Client </label>
                  </div>
                  <?php } ?>
                  <div class="clear"></div>