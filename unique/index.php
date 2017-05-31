<?php include_once("header2.php"); ?>
<div class="main">
  <div class="container_12">
    <div class="grid_12">
      <div class="slider-relative">
        <div class="slider-block">
          <div class="slider"> <a href="#" class="prev"></a><a href="#" class="next"></a>
            <ul class="items">
              <li><img src="images/slide.jpg" alt="">
                <div class="banner">
                  <div>One Window Solution</div>
                  <br>
                  <span>For Travel Agencies</span> </div>
              </li>
              <?php
              // Main banner
              $SQL1 = "SELECT * FROM tblbanner WHERE banner_status = 1 ORDER BY banner_id DESC";      
              $result1 = mysqli_query($connection, $SQL1) or die(mysqli_connect_error());
              if(count($result1) > 0)
              {
              while($row = mysqli_fetch_array($result1)) { ?>
              <li><img src="../utt-staff/images/banners/<?php echo $row['banner_image']; ?>" alt=""></li>
              <?php }
              } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container_12">
      <div class="grid_12">
        <h3>Our Services</h3>
      </div>
      <div class="boxes">
        <div class="grid_4">
          <figure>
            <div><img src="images/ticketing.jpg" alt=""></div>
            <figcaption>
              <h3>Ticketing</h3>
              We bring non stop ticketing solution in just on click, either they are BSP carriers or Web Based Carriers all in graphical interface for B2B services.</figcaption>
          </figure>
        </div>
        <div class="grid_4">
          <figure>
            <div><img src="images/hotel.jpg" alt=""></div>
            <figcaption>
              <h3>Visit Visa / Hotel Booking</h3>
              Now you may apply for visit visa or make your hotel booking at your own with Tours View. Hassel free services. No phone call No delay.</figcaption>
          </figure>
        </div>
        <div class="grid_4">
          <figure>
            <div><img src="images/24hours.jpg" alt=""></div>
            <figcaption style="height: 336px;">
              <h3>24/7 Help Line</h3>
              Our representative are available 24/7 via our dedicated helpline for your assistance.</figcaption>
          </figure>
        </div>
        <div class="clear"></div>
      </div>
      <div class="grid_8">

        <div id="tabs">
        <?php
          $SQL = "SELECT * FROM tblnotification WHERE text_status = 1 ORDER BY `date` DESC";            
           $result = mysqli_query($connection, $SQL) or die(mysqli_connect_error());
           while($row = mysqli_fetch_array($result)) { // ,MYSQL_ASSOC
           $text_color = $row['text_color'];
           $text_bold  = $row['text_bold'];
           if($text_color == 1)
              $text_color = "#000";
           elseif($text_color == 2)
              $text_color = "blue";
           elseif($text_color == 3)
              $text_color = "red";
           if($text_bold == 1)
              $text_bold = "bold";
            $image = $row['text_image'];
      ?>
        <h3 style="color: <?php echo $text_color; ?>; font-weight: <?php echo $text_bold; ?>; margin-top: 0px; margin-bottom: 0px;"><?php echo $row['marque_text']; ?></h3>
        <p style="font-weight: bold;">Date:<?php echo date("d-m-Y", strtotime($row['date'])); ?></p>
        <?php if(!empty($image)) { ?>
            <img src="images/notification_images/<?php echo $image; ?>" class="img-thumbnail" alt="Images">  
            <?php } ?>
        <?php } ?>
        </div>

      </div>
      <div class="grid_4" style="float: right;">
        <div class="newsletter_title">Notifications </div>
        <div class="n_container" style="height: 300px; padding-bottom: 0px;">
          <ul class="list" style="height: 300px;">
            <marquee scrollamount="2" direction="up" style="height: 300px;">
            <?php 
                $SQLText = "SELECT * FROM tbltext WHERE text_status = 1 ORDER BY text_id DESC";         
               $resultText = mysqli_query($connection, $SQLText) or die(mysqli_connect_error());
               if(count($resultText) > 0)
               {
               while($rowText = mysqli_fetch_array($resultText)) { // ,MYSQL_ASSOC
               $color = $rowText['text_color'];
               $bold = $rowText['text_bold'];
               if($color == 1)
                  $classColor = "black";
               else if($color == 2)
                  $classColor = "blue";
               else if($color == 3)
                  $classColor = "red";        
              if($bold == 1)
                  $classBold = "bld"; 

            ?>
            <li><?php echo $rowText['marque_text']; ?></li>
            <?php } }?>
            </marquee>
          </ul>
          
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <?php include_once("footer.php"); ?>