<?php
 include("header.php");
 include("classes.php");
  $obj=new backbone();
  $db=new db();
 if(isset($_POST['submit']))
 {
	$name=$_POST['name'];
	$mobile=$_POST['mobile'];
    $email=$_POST['email'];

    if(isset($_POST['securityQuestions'])!="0")
    {
    	$question=$_POST['securityQuestions'];

    }
    $answer=$_POST['answer'];

    $password=$_POST['Pass'];
    $confirmpassword=$_POST['confirmPass'];
    if($password==$confirmpassword or $name!="" or $mobile!="" or $email!="" or $question!="0" or $answer!="")
    {
       $obj->validateSignup($name,$mobile,$email,$question,$answer,$password,$db->conn);	
    }
    else
    {
    	echo "<script type='text/javascript'>alert('Either Passwords did not match or Some field left empty');</script>";
    	// return false;
    }
    
  //echo($question);
 }
?>
	<!---header--->
		
	<!---header--->
		<!---login--->
	<div class="content">
				<!-- registration -->
	<div class="main-1">
		<div class="container">
			<div class="register">
		  	  <form method="POST" action="account.php" id="signupForm"> 
				<div class="register-top-grid">
					<h3>personal information</h3>
					 <div>
						<span>Name<label>*</label></span>
						<input type="text" id="name" name="name" required> 
					 </div>
					 <div>
						<span>Mobile Number<label>*</label></span>
						<input type="text" name="mobile" id="mobile" required> 
					 </div>
					 <div>
						 <span>Email Address<label>*</label></span>
						 <input type="text" name="email" id="email" required>
						 <!-- pattern="/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"  -->
					 </div>
					 
					 
					 
					 <div class="clearfix"> </div>
					   <a class="news-letter" href="#">
						 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Sign Up for Newsletter</label>
					   </a>
				</div>
				
				<div class="register-bottom-grid">
						    <h3>login information</h3>
							 <div>
								<span>Password<label>*</label></span>
								<input type="password" name="Pass" id="Pass" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}$">
							 </div>
							 <div>
								<span>Confirm Password<label>*</label></span>
								<input type="password" name="confirmPass" required id="confirmPass" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}$">
							 </div>
				</div>
                
                <div class="register-bottom-grid">
					<h3>Security Questions</h3>
					<div>
					 	<select class="form-control" name="securityQuestions" id="securityQuestions" style="width:520px;">
                            <option value="0" selected>Security Question</option>
					 	    <option value="What was your childhood nickname?">What was your childhood nickname?</option>
                            <option value="What is the name of your favourite childhood friend?">What is the name of your favourite childhood friend?</option>
                            <option value="What was your favourite place to visit as a child?">What was your favourite place to visit as a child?</option>
                            <option value="What was your dream job as a child?">What was your dream job as a child?</option>
                            <option value="What is your favourite teacher's nickname?">What is your favourite teacher's nickname?</option>
                            
                        </select>
                    </div>
				    <div>
						 <input type="text"  id="answer" name="answer" style="width:525px;height:30px;"> 
					</div>
				</div>  
			    </form>

				<div class="clearfix"> </div>
				<div class="register-but">
				   <form method="POST">
					   <input type="submit" value="submit" id="submit" name="submit" form="signupForm" onclick="fetchValues()">
					   <div class="clearfix"> </div>
			        </form>
			    </div>
			</div>
		 </div>
	</div>
<!-- registration -->
    </div>
<!-- login -->
				<!---footer--->
	<script src="validateForm.js"></script>
	<?php include("footer.php"); ?>
			<!---footer--->
</body>
</html>