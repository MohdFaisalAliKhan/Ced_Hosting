<?php
// use PHPMailer/PHPMailer;
// require('') 
 include("header.php");
//       require_once("db.php");
      include('classes.php'); 
      
      if(isset($_POST['submitEmail']))
      {
		
		$receiverEmail=$_SESSION['user']['email'];
		$receiverPhone=$_SESSION['user']['mobile'];
		$OTP=rand(1000,4999);
		$_SESSION['OTP']=$OTP;
		$myEmail="faisalakhan98@gmail.com";
		//echo "<script type='text/javascript'> document.getElementById('emailField').value='$receiverEmail';</script>";

		require 'PHPMailerAutoload.php';
		$mail = new PHPMailer;
		$mail->SMTPDebug = 0;                              
		// Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = $myEmail;                 // SMTP username
		$mail->Password = 'tommarvoloriddle91699';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom($myEmail, 'Mailer');
		$mail->addAddress($receiverEmail);     // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		$mail->addReplyTo($myEmail);
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');

		// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Here is the subject';
		$mail->Body    = $OTP.' This is your otp';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
		    echo "<h4 style='color:green;'>Message could not be sent.</h4>";
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
				echo "<script>
				alert('Message sent successfully');
				window.location.href='EnterValidation.php';
				</script>";	
		}
      }

      if(isset($_POST['submitOTP']))
      {
		$receiverPhone=$_SESSION['user']['mobile'];
		$OTP=rand(5000,9999);
		$_SESSION['OTP']=$OTP;
		$fields = array(
			"sender_id" => "FSTSMS",
			"message" => $OTP.' This is your One Time Password',
			"language" => "english",
			"route" => "p",
			"numbers" => $receiverPhone,
		);
		
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_SSL_VERIFYHOST => 0,
		  CURLOPT_SSL_VERIFYPEER => 0,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode($fields),
		  CURLOPT_HTTPHEADER => array(
			"authorization: jH14BQnFoMpTq0XILNOmufGy3tw5iZax2rv8bcdKEk7JUeVgShR0LsHWuCZojSxk89YVmFtzOK54D2lr",
			"accept: */*",
			"cache-control: no-cache",
			"content-type: application/json"
		  ),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		echo "<script>
		  alert('Message sent successfully');
		  window.location.href='EnterValidation.php';
		  </script>";	
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
										<input type="text" name="email" id="emailField" disabled> 
									  </div>
									  <input type="submit" value="Verify through Email" name="submitEmail">
									  <div><br>
										<span>Mobile Number<label>*</label></span>
										<input type="text" name="mobile" id="numberField" disabled> 
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
				<script>
				    var e = '<?php echo $_SESSION['user']['email']; ?>';
					var p = '<?php echo $_SESSION['user']['mobile']; ?>';
				    document.getElementById("emailField").value=e;
					document.getElementById("numberField").value=p;
				</script>
				<?php include("footer.php"); ?>
			<!---footer--->
</body>
</html>