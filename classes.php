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
                    // if(($row['active']='0') && ( ($row['email_approved']='1') || ($row['phone_approved']='1')) && ($row['is_admin']='0') )
                    // 	// meaning user is blocked.
			        //   {
					// 	echo "<script>
					// 	alert('You have been blocked by the admin.');
					// 	</script>";	
			        //     // $_SESSION['admin']=array('is_admin'=>$row['is_admin'],
			        //     //                          'user_name'=>$row['user_name'],
			        //     //                          'user_id'=>$row['user_id'],
			        //     //                          'dateofsignup'=>$row['dateofsignup'],
			        //     //                          'mobile'=>$row['mobile'],
			        //     //                          'isblock'=>$row['isblock']);
			            
					//   }
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

	function categoryShow($conn)
	{
		$sql="SELECT * FROM `tbl_product`";
		$arr=array();
		$res=mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)>0)
		{
			while($row=$res->fetch_assoc())
			{
				$arr[]=$row;
			}
			return $arr;
		}
	}

	function parentProductName($id,$conn)
	{
		$sql="SELECT * FROM `tbl_product` WHERE `prod_parent_id`='$id'";
		$res=mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)>0)
		{
			while($row=$res->fetch_assoc())
			{
				if($row['prod_parent_id']==1)
				{ 
					$parent_name="Hosting";

				}
				$parent_name="Hosting";
			}
			return $parent_name;
		}
	}

	//ADD CATEGORY ME DROPDOWN ME PARENT KA NAME SHOW HO
	function showParentCategory($id,$conn)
	{
		$sql="SELECT * FROM `tbl_product` WHERE `id`='$id'";
		$res=mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)>0){
			while($row=$res->fetch_assoc())
			{
				$dropdown_value=$row['prod_name'];
			}
			return $dropdown_value;
		}

	}
	function insertTbl_product($prod_parent_id,$name,$html,$avail,$conn)
	{
		$sql="INSERT INTO tbl_product(`prod_parent_id`,`prod_name`,`html`,`prod_available`,`prod_launch_date`) VALUES ('$prod_parent_id','$name','$html','$avail',NOW())";
		$res=mysqli_query($conn,$sql);
		if($res==true)
		{
			echo "Record Inserted";
		}
		else{
			echo "Cannot insert record";
		}

	}

	function deleteCategory($CategoryName,$conn)
	{
		$sql="DELETE FROM `tbl_product` WHERE `prod_name`='$CategoryName'";
		$res=mysqli_query($conn,$sql);
		if($res==true)
        {
        echo "<script type='text/javascript'>alert('Category Deleted from Database.');
             window.location.href='admin/category.php';  

        </script>";
        // header("Location:../admin/AddNewLocation.php");
        }

	}

	function editCategory($ID,$conn)
	{
		$arr=array();
		$sql="SELECT * FROM `tbl_product` WHERE `id`='$ID'";
		$res=mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)>0)
		{
			while($row=$res->fetch_assoc())
			{
				$arr[]=$row;
			}
			return $arr;
		}
	}

	function updateTbl_product($name,$html,$avail,$conn,$ID)
	{
		$sql="UPDATE `tbl_product` SET `prod_name`='$name',
									 `html`='$html',
									 `prod_available`='$avail'
									  WHERE `id`='$ID'";
		$res=mysqli_query($conn,$sql);
		if($res==true)
		{
			echo "<script type='text/javascript'>  alert('Record Updated');
			     window.location.href='category.php' </script>";

		}
		else{
			echo "Cannot insert record";
		}

	}

	function addProduct($product_category,$product_name,$product_html,$product_available,$monthly,$yearly,$sku
						,$description ,$conn)
	{
		$sql="INSERT INTO `tbl_product`(`prod_parent_id`,`prod_name`,`html`,`prod_available`,`prod_launch_date`)
					 VALUES ('$product_category','$product_name','$product_html','$product_available',NOW())";
		$result=mysqli_query($conn,$sql);
		if($result==true)
		{
			$var=$conn->insert_id;
			$sql2="INSERT INTO `tbl_product_description`(`prod_id`,`description`,`mon_price`,`annual_price`,`sku`)
				VALUES ('$var','$description','$monthly','$yearly','$sku')";
			$result2=mysqli_query($conn,$sql2);
			if($result2==true)
			{
				echo "Record Inserted";
			}
			else{
				$sql3= "DELETE FROM `tbl_product` WHERE `tbl_product`.`id` = $var";
				$res=mysqli_query($conn,$sql3);
				echo "Product Not added.";
			}
		}
	}

	function viewproduct($conn)
	{
		$arr=array();
		$sql="SELECT * FROM `tbl_product` 
			  INNER JOIN `tbl_product_description`
			  ON `tbl_product`.id=`tbl_product_description`.prod_id";
		$res=mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)>0)
		{
			while($row=$res->fetch_assoc())
			{
				array_push($arr,$row);
			}
			return $arr;
		}
	}

	function getParentName($id,$conn)
	{
		$sql="SELECT * FROM `tbl_product` WHERE `id`='$id'";
		$res=mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)>0)
		{
			while($row=$res->fetch_assoc())
			{
				$name=$row['prod_name'];
			}
			return $name;
		}
	}

	// function to show entered values in edit product.php
	//Half values are shown from editCategory
	function editProduct($id,$conn)
	{
		$arr=array();
		$sql="SELECT * FROM `tbl_product_description` WHERE `prod_id`='$id'";
		$res=mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)>0)
		{
			while($row=$res->fetch_assoc())
			{
				$arr[]=$row;
			}
			return $arr;
		}
	}
	
	//to get parent name in edit product section
	function getParentNameEdit($id,$conn)
	{
		$sql="SELECT * FROM `tbl_product` WHERE `id`='$id'";
		$res=mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)>0)
		{
			while($row=$res->fetch_assoc())
			{
				$newID=$row['prod_parent_id'];
				//we get 12
			}
			$sql2="SELECT * FROM `tbl_product` WHERE `id`='$newID'";
			$res2=mysqli_query($conn,$sql2);
			if(mysqli_num_rows($res2)>0)
			{
				while($row2=$res2->fetch_assoc())
				{
					$newID2=$row2['prod_parent_id'];
					//mil gya 1
				}
				//return $newID2;
				 $sql3="SELECT * FROM `tbl_product` WHERE `prod_parent_id`='$newID2'";
				 $res3=mysqli_query($conn,$sql3);
				 $arr=array();
				  if(mysqli_num_rows($res3)>0)
				 {
				 	 while($row3=$res3->fetch_assoc())
				    {
						 array_push($arr,$row3);
					}
					return $arr;
					 
					//echo "TRUEEEEEEEEEEEE";


			    }
		
		    }
	    }

	}

	function updateTbl_productAndDescription($parent_id,$name,$html,$avail,$description,$month,$annual,$SKU,$conn,$ID)
	{
		//STEP 1
		//Updating Tbl_product
		$sql="UPDATE `tbl_product` SET `prod_parent_id`='$parent_id',
		                               `prod_name`='$name',
									   `html`='$html',
									   `prod_available`='$avail'
									   WHERE `id`='$ID'";
		$res=mysqli_query($conn,$sql);
		if($res==true)
		{
			//STEP 2
		    //Updating tbl_product_description
			$sql2="UPDATE `tbl_product_description` SET `mon_price`='$month',
			`annual_price`='$annual',
			`sku`='$SKU',
			`description`='$description'
			WHERE `prod_id`='$ID'";
			$res2=mysqli_query($conn,$sql2);
			if($res2==true)
			{
			echo "<script type='text/javascript'> 
			alert('Record Updated Successfully');
			window.location.href='category.php';
			</script>";
			   
		   }
		}
		else{
			echo "<script type='text/javascript'> 
			alert('Could not update');
			</script>";
		}
	}
	
	//Function to show category in hosting categories in header
	function headerCategoryShow($conn)
	{
		$arr=array();
		$sql="SELECT * FROM `tbl_product` WHERE `prod_parent_id`=1";
		$res=mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)>0)
		{
			while($row=$res->fetch_assoc())
			{
               array_push($arr,$row);
			}
			return $arr;
		}
	}

    //To show middle content when type of hosting is chosen from dropdown.
	function showHeaderinHosting($ID,$conn)
	{
		$arr=array();
		$sql="SELECT * FROM `tbl_product` WHERE `id`=$ID";
		$res=mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)>0)
		{
			while($row=$res->fetch_assoc())
			{
               array_push($arr,$row);
			}
			return $arr;
		}
	}
}

$db = new db();
$obj=new backbone();

if(isset($_GET['Name']))
    {
    	$CategoryName=$_GET['Name'];
    	$obj->deleteCategory($CategoryName,$db->conn);
    }















?>