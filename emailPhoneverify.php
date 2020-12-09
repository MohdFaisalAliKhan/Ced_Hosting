<?php
// use PHPMailer/PHPMailer;
// require('') 
 include("header.php");
//       require_once("db.php");
      include('classes.php'); 
      
      if(isset($_POST['submitEmail']))
      {
      	$blablaMail=$_GET['email'];
      	$email=$_POST['email'];

        $myEmail="@gmail.com";

		require 'PHPMailerAutoload.php';
		$mail = new PHPMailer;
		$mail->SMTPDebug = 0;                              
		// Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = $myEmail;                 // SMTP username
		$mail->Password = '';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom($myEmail, 'Mailer');
		$mail->addAddress($blablaMail);     // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		$mail->addReplyTo($myEmail);
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');

		// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Here is the subject';
		$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo 'Message has been sent';
		}
      }



      ?>
	<!---header--->
		<!---login--->
			<div class="content">
				<div class="main-1">
					<div class="container">
						<div class="login-page">
							<div class="account_grid">
								<!-- <div class="col-md-6 login-left">
									 <h3>new customers</h3>
									 <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
									 <a class="acount-btn" href="account.php">Create an Account</a>
								</div> -->
								<div class="col-md-6 login-right">
									<h3>Verify with Email or Phone Number</h3>
									<p>You'll be logged in shortly after confirming your identity</p>
									<form method="POST">
									  <div>
										<span>Email Address<label>*</label></span>
										<input type="email" name="email" required> 
									  </div>
									  <input type="submit" value="Verify through Email" name="submitEmail">
									  <div><br>
										<span>Mobile Number<label>*</label></span>
										<input type="text" name="mobile" > 
									  </div>
									  
									  <input type="submit" value="Verify through OTP" name="submitOTP"><br>
									  <a class="forgot" href="#">Forgot Your Password?</a>
									</form>
								</div>	
								<div class="clearfix"> </div>
							</div>
						</div>
					</div>
				</div>
			</div>
<!-- login -->
				<!---footer--->
				<?php include("footer.php"); ?>
			<!---footer--->
</body>
</html>