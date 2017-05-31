<?php include_once("header1.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <!-- Content Row -->
        <!-- Image Header -->
        <div class="row" style="margin-top:70px;">
            <div class="col-lg-12" style="margin-top:51px;">
                <img class="img-responsive" src="images/banner-contact.jpg" alt="Contact us">
            </div>
        </div>
        <div class="clear"></div>
        <div class="row">
            <!-- Map Column -->
            <!-- Contact Details Column -->
            <div class="col-md-6" style="margin-top:51px;">

                <p>
                    9-A, First Floor, Grand Hotel Davis Road, Lahore Pakistan
                </p>
                <p><i class="fa fa-phone"></i> 
                    <abbr title="Phone">P</abbr>: 042-36292761,62</p>
                <p><i class="fa fa-envelope-o"></i> 
                    <abbr title="Email">E</abbr>: <a href="mailto:info@toursview.com">info@toursview.com</a>
                </p>
                <p><i class="fa fa-clock-o"></i> 
                    <abbr title="Hours"></abbr>: Timing - 24/7</p>
                <ul class="list-unstyled list-inline list-social-icons">
                    <li>
                        <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-6 pull-right" style="margin-top:51px;">
                <!-- Embedded Google Map -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3399.603050760556!2d74.334231014644!3d31.56250678135568!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39191b35494efe13%3A0x2eb545e9d1140bee!2sThe+Grand+Inn!5e0!3m2!1sen!2s!4v1487872573343" width="100%" height="400px" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="col-md-6">
                <h3>Send us a Message</h3>
                <form name="sentMessage" id="contactForm" novalidate>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Full Name:</label>
                            <input type="text" class="form-control" id="name" required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Phone Number:</label>
                            <input type="tel" class="form-control" id="phone" required data-validation-required-message="Please enter your phone number.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Email Address:</label>
                            <input type="email" class="form-control" id="email" required data-validation-required-message="Please enter your email address.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Message:</label>
                            <textarea rows="10" cols="100" class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                        </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
        <!-- /.row -->

        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="row">
            

        </div>
        <!-- /.row -->

        <?php include_once("footer.php"); ?>
