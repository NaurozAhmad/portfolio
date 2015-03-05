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
$per_page=12;
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
<title>Chalghoza WWF</title>
<meta name="keywords" content="fresh zone, portfolio, theme, free web design, free css templates" />
<meta name="description" content="Fresh Zone, Portfolio, free CSS template by templatemo.com" />
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

<script type="text/javascript" src="js/jquery-1-4-2.min.js"></script> 
<link rel="stylesheet" href="css/slimbox2.css" type="text/css" media="screen" /> 
<script type="text/JavaScript" src="js/slimbox2.js"></script> 

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
                <li><a href="portfolio.php" class="selected">Gallary</a>
                   
                </li>
                <li><a href="contact.php">Contact</a></li>
                
            </ul>
            <br style="clear: left" />
        </div> <!-- end of templatemo_menu -->
    </div> <!-- END of templatemo_header -->
</div> <!-- END of templatemo_header_wrapper -->

<div id="templatemo_main_wrapper">
     
    <div id="templatemo_main">
 <?php $j=1 ;while ($row_pics = mysql_fetch_assoc($pics)) {?>
      <div class="gallery_box">
       		<a href="pics/<?php echo $row_pics['p_name'];?>" rel="lightbox[portfolio]"><img src="pics/<?php echo $row_pics['p_name'];?>" alt="Porfolio <?php echo $j;?>" class="imgage-with-frame" height="200px" width="200px" /></a>

            <h5><?php echo $row_pics['p_title'];?></h5>
            
        </div>
		 <?php $j++;}?>
<div class="cleaner"></div>
        <div class="pagging">
            <ul>
            
              <!--  <li><a href="portfolio.php" target="_parent">Previous</a></li>-->
                <li><a href="#" target="_parent">Pages</a>
            
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
        </div>   
        <div class="cleaner"></div>
                
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main_wrapper -->
</div> <!-- END of templatemo_main -->

<div id="templatemo_footer_wrapper">
	<div id="templatemo_footer">
    	Copyright © 2048 <a href="#">Your Company Name</a> | Designed by <a href="http://www.templatemo.com" target="_parent">Free CSS Templates</a>
    </div> <!-- END of templatemo_footer -->
</div> <!-- END of templatemo_footer_wrapper -->

</body>
</html>
<?php
mysql_free_result($pics);
?>
