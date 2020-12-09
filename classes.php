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
		    echo "<script type='text/javascript'>alert('Record Updated');</script>";

           //  $_SESSION['user']=array('email'=>$email,
           //                           'name'=>$name,
           //                           'mobile'=>$mobile,
           //                       );
	          // }



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
                    if(($row['active']==0))
                    	// row active=0 meaning abhi email se verify nhi hai
			          {
			            // $_SESSION['admin']=array('is_admin'=>$row['is_admin'],
			            //                          'user_name'=>$row['user_name'],
			            //                          'user_id'=>$row['user_id'],
			            //                          'dateofsignup'=>$row['dateofsignup'],
			            //                          'mobile'=>$row['mobile'],
			            //                          'isblock'=>$row['isblock']);
			            
			          }
	                else{

	                	//Row active 1 yani wo pehle se verified hai. 


			            // $_SESSION['user'] = array('is_admin'=>$row['is_admin'],
			            //                          'user_name'=>$row['user_name'],
			            //                          'user_id'=>$row['user_id'],
			            //                          'dateofsignup'=>$row['dateofsignup'],
			            //                          'mobile'=>$row['mobile'],
			            //                          'isblock'=>$row['isblock']);
			            }
			        }
		}
	} 
}

















?>