<?php include('menubar.inc.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/contact_us.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>

    <title>Contact Us</title>
</head>
<body?>


<div class="breadcrumb-area gray-bg">
            <div class="container">
                
                <div class="row">
                    <div class="col-12">
                        <div class="contact-message-wrapper  text-center">
                            <h4 class="contact-title ">CONTACT US</h4>
                            <div class="contact-message">
                            <p class=""><?php
			                 echo $_SESSION['c-msg']; 
                            
                                $_SESSION['c-msg'] = " Please fill the below form to send message."; ?>
                             </p>
                            
                                <form id="contact-form" action="contact-us-submit.php" method="post">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="contact-form-style mb-20">
                                                <input name="name" placeholder="Full Name" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="contact-form-style mb-20">
                                                <input name="email" placeholder="Email Address" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                                            </div>
                                        </div>
										<div class="col-lg-4">
                                            <div class="contact-form-style mb-20">
                                                <input name="mobile" placeholder="Mobile" type="tel" pattern="^\d{10}$" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="contact-form-style mb-20">
                                                <input name="subject" placeholder="Subject" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="contact-form-style">
                                                <textarea name="message" placeholder="Message" required></textarea>
                                                <button class="submit btn-style" type="submit">SEND MESSAGE</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>
<?php include('footer.inc.php'); ?>
