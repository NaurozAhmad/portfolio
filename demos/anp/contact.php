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
<title>Ayubia National Park</title>
<meta name="keywords" content="green jelly, theme, free templates, website templates, CSS, HTML" />
<meta name="description" content="Green Jelly is a free CSS template provided by templatemo.com" />
<link href="css/templatemo_style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />

<script language="javascript" type="text/javascript">
function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
</script>

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js">

/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "templatemo_menu", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>

<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
	
<script src="js/prototype.js" type="text/javascript"></script>
<script src="js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
<script src="js/lightbox.js" type="text/javascript"></script>
  
</head>
<body>

<div id="templatemo_wrapper">
	<div id="templatemo_header">
       <div id="header_left">
         <h2><a href="index.php"><img src="images/panda1.png" width="312" height="89"> </a>
       </div> 
       
       <div id="header_right">
       <img src="images/logo1.png" width="388" height="131" /> 
       <img src="images/coke.png" width="120" height="50"/></h2>
</div>	 <div id="templatemo_search">
           </div>
        <div class="cleaner"></div>
    </div> <!-- end of header -->
    
        <div id="templatemo_menu" class="ddsmoothmenu">  <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="portfolio.php">Gallery</a>
            
            <li><a href="maps.html">Map</a>
                
            </li>
            <li><a href="issues.html">Conservation Issue</a>
                      	</li>
          	<li><a href="biodiversity.html">Biodiversity</a></li>
   
            <li></li>
                   	  <li><a href="contact.php" class="selected">Contact Us</a></li>
            <a href="http://gr.forwallpaper.com/" title="ταπετσαρία της επιφάνειας εργασίας" class="header_nav"  target="_blank"><img src="images/templatemo_header_nav.png" alt="ταπετσαρία της επιφάνειας εργασίας" title="ταπετσαρία της επιφάνειας εργασίας" /></a>
        </ul><br style="clear: left" />
        
    </div> <!-- end of menu -->
    
    <div id="templatemo_main">
    	<h1>Contact Information</h1>
        <div class="col_2 float_r">
          <?php $test="Send us a message now!"; ?>
           
            <strong> <div id="show"><h4><?php if(isset($msg)){echo $msg;} else {echo $test;}?></h4></div></strong>
            <div id="contact_form">
                <form method="post" name="contact" action="#">
                        
                        <label for="author">Name:</label> <input type="text" id="author" name="author" class="required input_field" />
                        <div class="cleaner h10"></div>
                        <label for="email">Email:</label> <input type="text" id="email" name="email" class="validate-email required input_field" />
                        <div class="cleaner h10"></div>
                        
						<label for="subject">Subject:</label> <input type="text" name="subject" id="subject" class="input_field" />

						<div class="cleaner h10"></div>
        
                        <label for="text">Message:</label> <textarea id="text" name="text" rows="0" cols="0" class="required"></textarea>
                        <div class="cleaner h10"></div>
                        
                        <input type="submit" value="Send" id="submit" name="submit" class="submit_btn float_l" />
						
                        
            	</form>
            </div> 
        </div>
        <div class="col_2 float_l">
        
        	<h4>Mailing Address</h4>
            <h6><em>Ayubia National Park</em></h6>
          <p> <a href="http://en.wikipedia.org/wiki/Abbottabad_District" title="Abbottabad District">Abbottabad District</a>, <a href="http://en.wikipedia.org/wiki/Khyber_Pakhtunkhwa" title="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</a> province, northern <a href="http://en.wikipedia.org/wiki/Pakistan" title="Pakistan">Pakistan</a><br />
		  </p>
          <p><strong>Phone:</strong> 020-040-2400 <br />
              <strong>Email:</strong> <a href="mailto:info@company.com">info@company.com</a>  <br />
          </p>
    <div class="cleaner h20"></div>                    
            <h4>Our Location</h4>
            <a href="images/800px-Ayubia_clouds.jpg".jpg" rel="lightbox" title="Our Location"><img src="images/800px-Ayubia_clouds.jpg" height="400px" width="400px" alt="Map" /></a>
            
        </div>
        
		<br class="cleaner" />
    </div> <!-- end of main -->
    
   <center> 
            <div class="footer_social_button">
                <a href="#"><img src="images/facebook-32x32.png" title="facebook" alt="facebook" /></a>
                <a href="#"><img src="images/flickr-32x32.png" title="flickr" alt="flickr" /></a>
                <a href="#"><img src="images/twitter-32x32.png" title="twitter" alt="twitter" /></a>
                <a href="#"><img src="images/youtube-32x32.png" title="youtube" alt="youtube" /></a>
                <a href="#"><img src="images/rss-32x32.png" title="rss" alt="rss" /></a>
			</div>       		
        </center>
        <div class="cleaner"></div>
    </div> <!-- end of footer -->
</div>

<div id="templatemo_cr_bar_wrapper">
	<div id="templatemo_cr_bar">
    	Copyright © 2013 <a href="login.php">Ayubia National Park</a> | Designed by <a href="http://www.templatemo.com" target="_parent">Arif Hameed</a>
    </div>
</div>


<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>