<?php require_once('Connections/connection.php'); ?>
<?php 
if(isset($_POST['submit']))
{
	$firtname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$companyname=$_POST['companyname'];
	$subject=$_POST['subject'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$comments=$_POST['comments'];
	mysql_select_db($database_connection, $connection);
	$insert=mysql_query("INSERT INTO `form` VALUES ('','$firtname','$lastname','$companyname','$subject','$email','$phone','$comments')") or die(mysql_error());
	if($insert)
	{
		echo $msg="Inserted";
		}
		else
		{
			echo $msg="Not Inserted";
			}
	
	}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Jquery Simple Loader Modal Plugin</title>
<meta name="robots" content="noindex,nofollow">
	<link rel="stylesheet" href="css/demo.css" />
	<link rel="stylesheet" href="css/contactpopup.css" />
	<script src="js/jquery.js"></script>
    <script src="js/contactpopup.js"></script>
	<script src="js/demo.js"></script>
	<script type="text/javascript">
		$(function(){
			// Init Plugin
			$(".clickable").contactpopup({
				'formelement' : '#Form_PopContactUs',
				'transition' : '' // options - slide,fade,grow
			});
			$(".clickableFade").contactpopup({
				'formelement' : '#Form_PopContactUs',
				'transition' : 'fade' // options - slide,fade,grow
			});
			$(".clickableSlide").contactpopup({
				'formelement' : '#Form_PopContactUs',
				'transition' : 'slide' // options - slide,fade,grow
			});
			$(".clickableGrow").contactpopup({
				'formelement' : '#Form_PopContactUs',
				'transition' : 'grow' // options - slide,fade,grow
			});
		});
		
    </script>
</head>

<body>

<div id="pagewrapper">
     
                   
                <div class="content events careers">
                    <div id="column-1">
					
					<a class="clickableFade" href="#">Fade Effect</a>
					<a class="clickableSlide" href="#">Slide Effect</a>
					<a class="clickableGrow" href="#">Grow Effect</a>	
					</p>
					
		
                    	<form action="" method="POST" id="Form_PopContactUs" accept-charset="utf8" class="validateme" onsubmit="return validateCaptcha()" >

						        <input type="hidden" name="action" value="FormPost_ContactUs" class="action" />
						        
						        <fieldset>
						            <div class="col1">
						                <p>
						                    <span class="title">First Name<sup class="required">*</sup></span>
						                    <span class="element">
						                        <input type="text" class="validate[required] text" name="firstname" id="Text_FirstName" value="" />

						                    </span>
						                </p>

						                <p>
						                    <span class="title">Last Name<sup class="required">*</sup></span>
						                    <span class="element">
						                        <input type="text" class="validate[required] text" name="lastname" id="Text_LastName" value="" />
						                    </span>
						                </p>


						                <p>
						                    <span class="title">Company Name<sup class="required">*</sup></span>
						                    <span class="element">
						                        <input type="text" class="validate[required] text" name="companyname" id="Text_CompanyName" value="" />
						                    </span>
						                </p>
						
										<p>
						                    <span class="title">Subject<sup class="required">*</sup></span>
						                    <span class="element">
						                        <input type="text" class="validate[required] text" name="subject" id="Text_Subject" value="" />
						                    </span>
						                </p>
						        	</div>
						            <div class="col2">

						                <p>
						                    <span class="title">Email<sup class="required">*</sup></span>
						                    <span class="element">
						                        <input type="text" class="validate[required,custom[email]] text" name="email" id="Text_Email" value="" />
						                    </span>
						                </p>

						                <p>
						                    <span class="title">Phone<sup class="required">*</sup></span>

						                    <span class="element">
						                        <input type="text" class="validate[required] text" name="phone" id="Text_Phone" value="" />
						                    </span>
						                </p>

						                <p>
						                    <span class="title">Comments<sup class="required">*</sup></span>
						                    <span class="element">
						                        <textarea class="validate[required] textarea" name="comments" id="Textarea_Comments" value=""></textarea>

						                    </span>
						                </p>
						            </div>

						            <div class="clear"></div>

						        </fieldset>

						        <div class="button-pane">
						            <input type="submit" class="submit" name="submit" value="Contact Us" id="Submit_PopContactUs" />
						            <div class="clear"></div>
						        </div>

						    </form>
						
					</div>
					<div class="clear"></div>
                </div>
            </div>
		</div> 
    </div>
</body>
</html>
