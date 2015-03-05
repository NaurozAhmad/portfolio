<?php require_once('Connections/connection.php'); ?>
<?php if(isset($_POST['submit']))
{
	$author=$_POST['author'];
	$sender=$_POST['email'];
	$subject=$_POST['subject'];
	$message=$_POST['text'];
	mysql_select_db($database_connection, $connection);
	$insert=mysql_query("INSERT INTO contact VALUES ('','$author','$sender','$subject','$message',NOW())") or die(mysql_error());
	if($insert)
	{
		$msg="****** Message Sent Successfully ******";	
		}
		else{
			$msg= "Some Error Occured";
			}
	
	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Chalghoza WWF</title>
<meta name="keywords" content="fresh zone, contact page, location maps, free templates, CSS" />
<meta name="description" content="Fresh Zone, Contact Page, Location Maps, free CSS template by templatemo.com" />
<link href="css/templatemo_style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js">

/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "templatemo_menu", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>

<link rel="stylesheet" type="text/css" media="all" href="css/jquery.dualSlider.0.2.css" />

<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="js/jquery.timers-1.2.js" type="text/javascript"></script>
<script src="js/jquery.dualSlider.0.3.min.js" type="text/javascript"></script>

<script type="text/javascript">
    
    $(document).ready(function() {
        
        $("#carousel").dualSlider({
            auto:true,
            autoDelay: 6000,
            easingCarousel: "swing",
            easingDetails: "easeOutBack",
            durationCarousel: 1000,
            durationDetails: 600
        });
        
    });   
    
</script>

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="templatemo_header_wrapper">
	<div id="templatemo_header">
    	<div id="site_title"><div align="left"></div>
		  <div><img src="images/logo.png" width="330" height="120" align="bottom" />		  </div>
    	</div>
        <div id="templatemo_menu" class="ddsmoothmenu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.html">About</a>
                  
                </li>
                <li><a href="portfolio.php">Gallary</a>
                    
                </li>
                <li><a href="contact.php">Contact</a></li>
                
            </ul>
            <br style="clear: left" />
        </div> <!-- end of templatemo_menu -->
    </div> <!-- END of templatemo_header -->
</div> <!-- END of templatemo_header_wrapper -->

<div id="templatemo_main_wrapper">
    <div id="templatemo_main">
    	
        <h2>Contact Information</h2>
        <div class="half float_l">
			<?php $test="Send us a message now!"; ?>
           
            <strong> <div id="show"><h4><?php if(isset($msg)){echo $msg;} else {echo $test;}?></h4></div></strong>
            <div id="contact_form">
             
				<form method="post" name="contact" action="#">
					
					<label for="author">Name:</label>
		    <span id="sprytextfield1">
					<input type="text" id="author" name="author" class="required input_field" />
					<span class="textfieldRequiredMsg">A value is required.</span></span>
		      <div class="cleaner h10"></div>
													
					<label for="email">Email:</label>
			    <span id="sprytextfield2">
                <input type="text" class="validate-email required input_field" name="email" id="email" />
                <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span>
  <div class="cleaner h10"></div>
											
					<label for="subject">Subject:</label>
			    <span id="sprytextfield3">
					<input type="text" class="validate-subject required input_field" name="subject" id="subject"/>
					<span class="textfieldRequiredMsg">A value is required.</span></span>
<div class="cleaner h10"></div>
							
					<label for="text">Message:</label>
					<span id="sprytextarea1">
					<textarea id="text" name="text" rows="0" cols="0" class="required"></textarea>
					<span class="textareaRequiredMsg">A value is required.</span></span><span id="sprytextfield5"><span class="textfieldRequiredMsg">A value is required.</span></span>		    <span id="sprytextfield4"><span class="textfieldRequiredMsg">A value is required.</span></span>
<div class="cleaner h10"></div>				
												
					<input type="submit" value="Send" id="submit" name="submit" class="submit_btn float_l" />
				</form>
              
            </div>
		</div>
        <div class="half float_r">
			<h4>Our Location</h4>
             <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=wwf+peshawar&amp;aq=&amp;sll=37.055177,-95.668945&amp;sspn=0.004855,0.010568&amp;ie=UTF8&amp;hq=&amp;hnear=WWF+office,+Abdara+Rd,+Peshawar,+Peshawar+District,+Khyber+Pakhtunkhwa,+Pakistan&amp;t=m&amp;ll=34.000731,71.498165&amp;spn=0.024905,0.036478&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=wwf+peshawar&amp;aq=&amp;sll=37.055177,-95.668945&amp;sspn=0.004855,0.010568&amp;ie=UTF8&amp;hq=&amp;hnear=WWF+office,+Abdara+Rd,+Peshawar,+Peshawar+District,+Khyber+Pakhtunkhwa,+Pakistan&amp;t=m&amp;ll=34.000731,71.498165&amp;spn=0.024905,0.036478&amp;z=14&amp;iwloc=A" style="color:#0000FF;text-align:left">View Larger Map</a></small>
            
            <div class="cleaner h40"></div>
            <h6><strong>Company Name</strong></h6>
				205-230 In pellentesque pharetra, <br />
                In pellentesque eleifend, 10520<br />
                Suspendisse metus quam<br /><br />
                
            <strong>Phone:</strong> 082-447-0850<br />
			<strong>Email:</strong> <a href="mailto:info@yoursite.com">info@yoursite.com</a>
        </div>
        
        <div class="cleaner h40"></div>
        
    </div> <!-- END of templatemo_main_wrapper -->
</div> <!-- END of templatemo_main -->

<div id="templatemo_footer_wrapper">
	<div id="templatemo_footer">
    	Copyright © 2048 <a href="#">Your Company Name</a> | Designed by <a href="http://www.templatemo.com" target="_parent">Free CSS Templates</a>
    </div> <!-- END of templatemo_footer -->
</div> <!-- END of templatemo_footer_wrapper -->

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email", {validateOn:["blur"], hint:"Email Address"});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"]});
</script>
</body>
</html>