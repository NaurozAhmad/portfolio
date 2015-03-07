
<?php require_once('Connections/connection.php'); ?>
<?php 
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}


mysql_select_db($database_connection, $connection);

$query_news = "SELECT * FROM news";
$news = mysql_query($query_news, $connection) or die(mysql_error());
//$row_news = mysql_fetch_assoc($news);
$totalRows_news = mysql_num_rows($news);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ayubia National Park</title>
<meta name="keywords" content="green jelly, theme, free templates, nivo image slider, website, templatemo, CSS, HTML" />
<meta name="description" content="Green Jelly Theme, free CSS template provided by templatemo.com" />
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
</div>	 
        <div id="templatemo_search">
           </div>
        <div class="cleaner"></div>
    </div> <!-- end of header -->
    
    <div id="templatemo_menu" class="ddsmoothmenu">
        <ul>
            <li><a href="index.php" class="selected">Home</a></li>
            <li><a href="portfolio.php">Gallery</a>
            
            <li><a href="maps.html">Map</a>
                
            </li>
            <li><a href="issues.html">Conservation Issue</a>
                      	</li>
          	<li><a href="biodiversity.html">Biodiversity</a></li>
   
                      	<li><a href="contact.php">Contact Us</a></li>
            <a href="http://gr.forwallpaper.com/" title="ταπετσαρία της επιφάνειας εργασίας" class="header_nav"  target="_blank"><img src="images/templatemo_header_nav.png" alt="ταπετσαρία της επιφάνειας εργασίας" title="ταπετσαρία της επιφάνειας εργασίας" /></a>
        </ul>
        <br style="clear: left" />
    </div> <!-- end of menu -->
    
    <div id="templatemo_slider_wrapper">
        
        <div id="slider" class="nivoSlider">
            <img src="images/slider/05.jpg" alt="Slider 01" title="Cheetah In Ayubia National Park" />
            <img src="images/slider/06.jpg" alt="Slider 02" title="Beautiful View" />
            <img src="images/slider/07.jpg" alt="Slider 03" title="Church near Ayubia National Park" />
            <img src="images/slider/08.jpg" alt="Slider 04" title="Beautiful Cottage" />
            <img src="images/slider/09.jpg" alt="Slider 05" title="Snow Fall" />
            <img src="images/slider/10.jpg" alt="Slider 06" title="Lack View" />
            <img src="images/slider/11.jpg" alt="Slider 07" title="Ice Covered Mountains" />
        
           
 			<img src="images/slider/14.jpg" alt="Slider 10" title="Lift Chairs" />
            <img src="images/slider/15.jpg" alt="Slider 11" title="Guest Houses" />
            <img src="images/slider/02.jpg" alt="Slider 12" title="Pigeons" />
            
            </div>
        
        <div id="htmlcaption" class="nivo-html-caption">
        	<strong>This</strong> is an example of a HTML caption with <a href="#">a link</a>.
        </div>
    
    </div>
    
    <script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
    $('#slider').nivoSlider();
    });
    </script>
    
    <div id="templatemo_main">
        <div class="col_2 float_l">
        	<h2>Welcome To Ayubia National Park </h2>
            <br class="cleaner h20" />
          
            <p><a href="http://www.templatemo.com" target="_parent">Ayubia National Park </a> is one of the most popular tourist hill resorts in Pakistan with approximately 250,000 tourists visiting annually, particularly during the summer season. It is very rich in biodiversity and provides an excellent habitat to important plants and wildlife species.</p>
          <br class="cleaner h20" />
          <p>Ayubia National Park (ANP) covers an area of approximately 3,312ha and is located within the Western Himalayan global ecoregion. The Western Himalayas is also the catchment area for 70-80% of water from the melting of snow and glaciers to the Indus Delta. Its significance in watershed management is critical; deforestation in the area will have far reaching consequences that will have negative impact in the Indus and Ganges deltas.</p>
          <br class="cleaner h20" />
          <p>The Project will focus on the following 3 areas:</p>
            <ul>
                <li>Sub-watershed management</li>
                <li>Awareness raising and capacity building</li>
                <li>Community development through introduction of alternate sources of energy, rainwater harvesting, crop diversification, habitat restoration and water filtration</li>
                           </ul>
            <div class="cleaner h20"></div>
            <br class="cleaner" />
        </div>
        
        <div class="col_2 float_r">
        	<h2>Latest News</h2>
           <marquee  behavior="scroll" direction="up" scrollamount="2" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 2, 0)"; >
 <?php $a="********************************************************";
 $b="--------------------------------------------------------------------------------------";
  while ($row_news = mysql_fetch_assoc($news)){?>
    <h5><?php echo $row_news['n_title']; ?></h5>

<p><?php echo date('d-m-Y',strtotime($row_news['n_date'])); ?></p>

    <p><?php echo $row_news['n_desc']; ?> </p>
    <p><?php echo $a; ?> </p>
  <?php } ; ?>
  </marquee>
  <?php echo $b; ?>
            <p><em>Latest News are Updated here 24/7 <a href="http://validator.w3.org/check?uri=referer" rel="nofollow"></em></p>
	 	    <br class="cleaner" />
        </div>
        
		<br class="cleaner" />
            <div class="col_4">
            <h3 class="fp_h3"> Role of National Parks</h3>
            <p>In eget felis vitae massa dignissim venenatis vitae a dolor. Praesent bibendum hendrerit ante, pretium vehicula ante malesuada ac.</p>
           </div>
        
        <div class="col_4">
            <h3 class="fp_h3">Purpose & Objective</h3>
            <p>Donec euismod adipiscing diam ac porttitor. Proin hendrerit ligula a erat semper suscipit. Duis lobortis turpis vitae ante placerat cursus.</p>
           </div>
        
        <div class="col_4">
            <h3 class="fp_h3">Fauna & Flora</h3>
          <p>Etiam eu diam ac quam fermentum ultrices sit amet ac tortor. Mauris ultricies rhoncus odio, condimentum erat eleifend sed.</p>
           </div>
        
        <div class="col_4 col_l">
            <h3 class="fp_h3">Park Management</h3>
          <p>Ut euismod tellus sit amet orci condimentum scelerisque. Vivamus aliquam tempor arcu, in tristique arcu convallis ac. </p>
            </div>
        
        <div class="cleaner hr_divider"></div>
        
    
    </div> <!-- end of main -->
    
                <div class="cleaner"></div>
        </div>
   <center> 
            <div class="footer_social_button">
                <a href="#"><img src="images/facebook-32x32.png" title="facebook" alt="facebook" /></a>
                <a href="#"><img src="images/flickr-32x32.png" title="flickr" alt="flickr" /></a>
                <a href="#"><img src="images/twitter-32x32.png" title="twitter" alt="twitter" /></a>
                <a href="#"><img src="images/youtube-32x32.png" title="youtube" alt="youtube" /></a>
                <a href="#"><img src="images/rss-32x32.png" title="rss" alt="rss" /></a>
			</div>       		
        </center>
        </div>
        <div class="cleaner"></div>
    </div> <!-- end of footer -->
</div>

<div id="templatemo_cr_bar_wrapper">
	<div id="templatemo_cr_bar">
    	Copyright © 2013 <a href="login.php">Ayubia National Park</a> | Designed by <a href="" target="_parent">Arif Hameed</a>
    </div>
</div>


<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>

<?php

mysql_free_result($news);
?>