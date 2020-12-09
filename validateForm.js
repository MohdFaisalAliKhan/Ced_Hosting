 $(document).ready(function(){


            //MOBILE NUMBER CHECKING
            $("#mobile").on("blur",function(){
                var mobile=$("#mobile").val();
                var firstDigit = mobile.charAt(0);
                var secondDigit=mobile.charAt(1);

               // Condition to check for 11 digit mobile number
                if(mobile.match(/^[0-9]{11}$/))
                {
                	if(firstDigit==0)
	                {
	                	if(secondDigit==0)
	                	{
	                		alert("Second Digit cannot be 0 in the mobile number.");
	                		$("#mobile").val("");
	                		return false;
	                	}
	                	else{
	                		for(var i=2;i<mobile.length;i++) {
					            var temp = mobile.charAt(i);
							      if(secondDigit != temp) {
							         $("#mobile").val(mobile);
							         return true;
							      }
							    }
						 alert("All the digits are same");
						 $("#mobile").val("");
						 return false;
	                	}
	                }

	                else{
	                	alert("Entered mobile number contains 11 digits without 0 in front.");
	                	$("#mobile").val("");
	                	return false;
	                }

                }
                //Condition to check for 10 digit mobile number
                if(mobile.match(/^[0-9]{10}$/))
                {
                	if(firstDigit==0)
	                {
	                	alert("Entered 10 digit mobile number cannot start with a 0.");
	                	$("#mobile").val("");
	                	return false;
	                }
                	else{
                		for(var i=1;i<mobile.length;i++) {
				            var temp = mobile.charAt(i);
						      if(secondDigit != temp) {
						          $("#mobile").val(mobile);
						         return true;
						      }
						    }
					 alert("All the digits are same");
					 $("#mobile").val("");
					 return false;
                	}

                }
                //If no digit is
                else{
                     alert("Entered Mobile Number contains letters that are not allowed");
                     $("#mobile").val("");
                     return false;
                }
                
            });


            //NAME CHECKING
            $("#name").on("blur",function(){
            	var n=$("#name").val();
            	var name=n.trim();
            	if(name.match(/^[a-zA-Z]+(\s[a-zA-Z]+){1,}?$/))
            	{
            		$("#name").val(name);
            		return true;
            	}
            	else{
            		alert("Invalid Name, please try again");
            		$("#name").val("");
            		return false;
            	}
            	//To trim any whitespaces at beginning or start.
            });

            //EMAIL VERIFICATION
            $("#email").on("blur",function(){
                 var e=$("#email").val();
                 var email=e.trim();
                 if(email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/))
                 {
                 	$("#email").val(email);
                 	return true;
                 }
                 else{
                 	alert("Invalid Email, please try again");
                 	$("#email").val("");
                 	return false;
                 }
            });

            //ANSWER VERIFICATION
            $("#answer").on("blur",function(){
            	var a=$("#answer").val();
            	var answer=a.trim();
            	if(answer.match(/^[a-zA-Z0-9]+(\s[a-zA-Z0-9!@#$%^&*]+){1,}?$/))
            	{
            		$("#answer").val(answer);
            		return true;
            	}
            	else{
            		alert("invalid answer");
            		$("#answer").val("");
            		return false;
            	}

            })


            
        });