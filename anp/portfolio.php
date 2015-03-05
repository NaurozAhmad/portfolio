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
$per_page=20;
$start=0;
$end='';
if(isset($_GET['page']))
{
	$page=$_GET['page'];
	$start=($page-1)*($per_page);
	}
	else{
		$page=1;
		}
	
mysql_select_db($database_connection, $connection);
$query_pics = "SELECT * FROM pics LIMIT $start,$per_page";
$t_query=mysql_query("SELECT * FROM pics") or die(mysql_error());
$t_no=mysql_num_rows($t_query);
 $noof_pages= ceil($t_no/$per_page);

$pics = mysql_query($query_pics, $connection) or die(mysql_error());
//$row_pics = mysql_fetch_assoc($pics);
$totalRows_pics = mysql_num_rows($pics);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ayubia National Park</title>
<meta name="keywords" content="green jelly, portfolio, free web design, free css templates, templatemo.com" />
<meta name="description" content="Green Jelly, Portfolio, free CSS template by templatemo.com" />
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
    
    <div id="templatemo_menu" class="ddsmoothmenu">
         <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="portfolio.php" class="selected">Gallery</a>
            
            <li><a href="maps.html">Map</a>
                
            </li>
            <li><a href="issues.html">Conservation Issue</a>
                      	</li>
          	<li><a href="biodiversity.html">Biodiversity</a></li>
<li><a href="contact.php">Contact Us</a></li>
        <br style="clear: left" />
    </div> <!-- end of menu -->
     
    <div id="templatemo_main">
    	<h1>Portfolio</h1>
   
         
        <?php $j=1 ;while ($row_pics = mysql_fetch_assoc($pics)) {?>
       <ul id="gallery">
            <li><a href="pics/<?php echo $row_pics['p_name'];?>" rel="lightbox[portfolio]"><img src="pics/<?php echo $row_pics['p_name'];?>" alt="Image <?php echo $j;?>" height="200px" width="300" /><?php echo $row_pics['p_title'];?></a></li>
        </ul>   
 
        <?php $j++; }?>
        
      
       
 
           <div class="pagging">
         <div class="cleaner"></div>  
            <ul>
            
              <!--  <li><a href="portfolio.php" target="_parent">Previous</a></li>-->
                <li><a href="portfolio.php?page=1" target="_parent">Home</a>
            
            <?php 
			if(isset($_GET['page']))
			{
				$i=($_GET['page']-1)*($per_page)+1;
				}
				else
				{
					$i=1; 
					}
			for($i=1;$i<=$noof_pages;$i++) {
            
						
                 echo '<li><a href="portfolio.php?page='.$i.'" target="_parent">'.$i.'</a></li>'; } ?>
               
			   <!-- <li><a href="http://www.templatemo.com/page/7" target="_parent">Next</a></li>-->
            </ul>
     
            <div class="cleaner"></div>
        </div>
        
    </div> <!-- end of main -->
      </center>
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
  
        </div>
        <div class="cleaner"></div>
    </div> <!-- end of footer -->
</div>

<div id="templatemo_cr_bar_wrapper">
	<div id="templatemo_cr_bar">
    	Copyright © 2013 <a href="login.php">Ayubia National Park</a> | Designed by Arif Hameed
    </div>
</div>


<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>
<?php
mysql_free_result($pics);
?>
