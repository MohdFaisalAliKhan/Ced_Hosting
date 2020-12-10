<?php
include("db.php");

class backbone
{
	function validateSignup($name,$mobile,$email,$question,$answer,$password,$conn)
	{
		$confirmEmailPhone="SELECT * FROM `tbl_user` WHERE `mobile`='$mobile' OR `email`='$email'";
		$r=mysqli_query($conn,$confirmEmailPhone);
		if(mysqli_num_rows($r)>0)
		{
			echo "<script type='text/javascript'>alert('Same Mobile or Email already exists.');</script>";
              return false;
		}
		else
		{
			$sql="INSERT INTO `tbl_user`(`name`,`mobile`,`email`,`security_question`,`security_answer`,`password`,`email_approved`,`phone_approved`,`active`,`is_admin`) VALUES ('$name','$mobile','$email','$question','$answer','$password',0,0,0,0)";
		    $res=mysqli_query($conn,$sql);
		    

            $_SESSION['user']=array('email'=>$email,
                                     'name'=>$name,
                                     'mobile'=>$mobile,
                                 );
			  
			echo "<script type='text/javascript'>alert('Record Updated');</script>";
			echo ("<script type='text/javascript'> window.location.replace('emailPhoneverify.php?email=".$email."&mobile=".$mobile."');</script>");	
				
		}
	}

		

	
	function validateLogin($email,$password,$conn)
	{
       	$validateUser="SELECT * FROM `tbl_user` WHERE `email`='$email' AND `password`='$password'";
    	$res=mysqli_query($conn,$validateUser);
        if($res->num_rows >0)
    	{
    		while($row = $res->fetch_assoc()){
                    if(($row['active']='0') && ( ($row['email_approved']='1') || ($row['phone_approved']='1')) && ($row['is_admin']='0') )
                    	// meaning user is blocked.
			          {
						echo "<script>
						alert('You have been blocked by the admin.');
						</script>";	
			            // $_SESSION['admin']=array('is_admin'=>$row['is_admin'],
			            //                          'user_name'=>$row['user_name'],
			            //                          'user_id'=>$row['user_id'],
			            //                          'dateofsignup'=>$row['dateofsignup'],
			            //                          'mobile'=>$row['mobile'],
			            //                          'isblock'=>$row['isblock']);
			            
					  }
					if( $row['is_admin']=='0' && ( $row['active']='1' && ($row['phone_approved']='1' || $row['email_approved']='1') ) )
					{
						//Login kr skta hai
						//USER HAI
						$_SESSION['userdata'] =
							array('is_admin'=>$row['is_admin'],
							    'id'=>$row['id'],
								'name'=>$row['name'],
								'email'=>$row['email'],
								'email_approved'=>$row['email_approved'],
								'mobile'=>$row['mobile'],
								'phone_approved'=>$row['phone_approved'],
								'sign_up_date'=>$row['sign_up_date'],
								'security_question'=>$row['security_question'],
								'security_answer'=>$row['security_answer']
							);


						echo "<script>
								alert('You can login now');
								window.location.href='index.php';
								</script>";	

					}
					if ($row['is_admin']=='1')
					{
						echo "<script>
								alert('Welcome Admin');
								</script>";
								$_SESSION['userdata'] =
								     array('is_admin'=>$row['is_admin'],
									'id'=>$row['id'],
									'name'=>$row['name'],
									'email'=>$row['email'],
									'email_approved'=>$row['email_approved'],
									'mobile'=>$row['mobile'],
									'phone_approved'=>$row['phone_approved'],
									'sign_up_date'=>$row['sign_up_date'],
									'security_question'=>$row['security_question'],
									'security_answer'=>$row['security_answer']
								);

                                echo "<script>
								 window.location.href='admin/index.php';
								 </script>";	

					}
					else{
						echo "not opening";
					}
	               
			        }
		}
		else{
			echo "No such record in database .Please Signup first";
		}
	}
	
	

	function emailValidate($OTPEntered,$OTPFast2sms,$mobile,$conn)
	{
		if($OTPEntered==$OTPFast2sms)
		{
			$sql="UPDATE `tbl_user` SET `email_approved`=1 ,
			`active`=1 WHERE `mobile`='$mobile'";
			$result=mysqli_query($conn,$sql);
			echo "<h4 style='color:green;'>Email Verified<h4>";
			echo "<script>
				alert('Email Verified');
				window.location.href='login.php';
				</script>";	
		}
		else{
			echo "<h4 style='color:red;'>Could not verify Email.<h4>";
		}

	}

	function phoneValidate($OTPEntered,$OTPFast2sms,$mobile,$conn)
	{
		if($OTPEntered==$OTPFast2sms)
		{
			$sql="UPDATE `tbl_user` SET `phone_approved`=1 ,
			`active`=1 WHERE `mobile`='$mobile'";
			$result=mysqli_query($conn,$sql);
			echo "<h4 style='color:green;'>Entered mobile OTP is Correct<h4>";
			echo "<script>
				alert('Mobile verified');
				window.location.href='login.php';
				</script>";	
		}
		else{
			echo "<h4 style='color:red;'>Entered mobile OTP is incorrect<h4>";
		}

	}
}

















?>