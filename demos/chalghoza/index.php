
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
$query_showprojects = "SELECT * FROM projects";
$showprojects = mysql_query($query_showprojects, $connection) or die(mysql_error());
$row_showprojects = mysql_fetch_assoc($showprojects);
$totalRows_showprojects = mysql_num_rows($showprojects);

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
<title> Chalghoza WWF </title>
<meta name="keywords" content="fresh zone, free theme, free templates, templatemo, dualSlider, CSS, HTML" />
<meta name="description" content="Fresh Zone Theme, free CSS template provided by templatemo.com" />
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
<style type="text/css">

.newsitem {
    background-color: #F8F8F9;
    border: 1px dotted #ccc;
    border-bottom: 0;
    width: 250px;
    padding: 10px 40px 10px 20px;
    font: normal 10px/1.5em Arial Verdana, sans-serif;
    color: #999;
	height:200px;
	border-bottom:#000 dotted 1px;
}

.newsitem h3 {
    background: url("../images/icon_news.gif") no-repeat 0 50%;
    margin: 0;
    position: relative;
    padding-left: 20px;
    color: #900;
    font-weight: normal;
}

.newsitem h3 span {
    color: #818181;
    position: absolute;
    top: 0;
    right: 0;
	font-size:12px;
}

.newsitem p {
    padding-left: 20px;
    font-size:12px
	}
</style>
</head>
<body>

<div id="templatemo_header_wrapper">
	<div id="templatemo_header">
    	<div id="site_title">
    	  <div align="left"></div>
		  <div><img src="images/logo.png" width="330" height="120" align="bottom" />		  </div>
    	</div>
        <div id="templatemo_menu" class="ddsmoothmenu">
            <ul>
                <li><a href="index.php" class="selected">Home</a></li>
                <li><a href="about.html">About</a>
                    
                </li>
                <li><a href="portfolio.php">Gallery</a>
                    
                </li>
                <li><a href="contact.php">Contact</a></li>
                
            </ul>
            <br style="clear: left" />
        </div> <!-- end of templatemo_menu -->
    </div> <!-- END of templatemo_header -->
</div> <!-- END of templatemo_header_wrapper -->

<div id="templatemo_slider_wrapper">
	<div id="templatemo_slider">
	<div id="carousel">
    	<div class="panel">
				
				<div class="details_wrapper">
					
					<div class="details">
					
                    <div class="detail">
							<h2><a href="#">Introduction</a></h2>
                            <p>One of the largest stands in the World, Chilghoza Forests of Suleiman Range is spaced over 260km2. These forests play an important role both as ecological and environmental services besides providing a credible source of income to local communities. Due to increase in population coupled with lack of alternate livelihood opportunities, Chilghoza Forests are under constant pressure for timber.</p>
							
						</div><!-- /detail -->
                    
						<div class="detail">
							<h2><a href="#">Chilghoza</a></h2>
                            <p>Chilghoza is a common dry fruit in winter for the natives in Pakistan and Afghanistan, but now it has become the most expensive and rare fruit. Few years back vendors used to sell baked as well as raw Chilghoza on donkey carts and handcarts in bazaars and streets in Khyber Pakhtunkhwa ahead of and during winter season.
Retailers say that Chilghoza is in short supply from Afghanistan, Balochistan and northern areas of the country as a result its prices shot up tremendously. But forest conservators term export to China as one of the major factors of the increase in its price.</p>
							
						</div><!-- /detail -->
						
						<div class="detail">
							<h2><a href="#">Research</a></h2>
                            <p>Syed Kamran Hussain, research coordinator, World Wildlife Fund (WWF), told that export to China was one of the major factors which affected supply of Chilghoza to the local market.
He said that pine nuts were used in manufacturing cosmetics in China. Another reason, he said, was bad seed production because it decreased after every five or six years, which was natural.</p>
							
						</div><!-- /detail -->
						
						<div class="detail">
							<h2><a href="#">Found</a></h2>
                            <p>Chilghoza forests were found over 26,000-hectare area in Shirani District of Balochistan province covered area. They said that Chilghoza forests of Suleiman Mountains were not only ecologically unique, but had tremendous importance from socio-economic perspective of the local communities.</p>
							
						</div><!-- /detail -->
                        
                        <div class="detail">
							<h2><a href="#">Benefits</a></h2>
                            <p>Income earned from Chilghoza nuts directly goes to the improvement of livelihood of the forest-owning communities besides serving the cause of conservation and proper management of ecosystem.</p>
							
						</div><!-- /detail -->
					
					</div><!-- /details -->
					
				</div><!-- /details_wrapper -->
				
				<div class="paging">
					<div id="numbers"></div>
					<a href="javascript:void(0);" class="previous" title="Previous" >Previous</a>
					<a href="javascript:void(0);" class="next" title="Next">Next</a>
				</div><!-- /paging -->
				
				<a href="javascript:void(0);" class="play" title="Turn on autoplay">Play</a>
				<a href="javascript:void(0);" class="pause" title="Turn off autoplay">Pause</a>
				
	  </div><!-- /panel -->
			
      <div id="slider-image-frame">
                <div class="backgrounds">
                    
                     <div class="item item_1">
                        <img src="images/slider/sli.jpg" alt="Image 01" />
                    </div><!-- /item -->
                    
                    <div class="item item_2">
                        <img src="images/slider/11.jpg" alt="Image 02" />
                    </div><!-- /item -->
                    
                    <div class="item item_3">
                        <img src="images/slider/22.jpg" alt="Image 03" />
                    </div><!-- /item -->
                    
                    <div class="item item_4">
                        <img src="images/slider/33.jpg" alt="Image 04" />
                    </div><!-- /item -->
                        
                      <div class="item item_5">
                        <img src="images/slider/03.jpg" alt="Image 05" />
                    </div><!-- /item -->
                    
                </div><!-- /backgrounds -->
			</div>
		</div>
    </div> <!-- END of templatemo_slider -->
</div> <!-- END of templatemo_slider_wrapper -->

<div id="templatemo_main_wrapper">
    <div id="templatemo_main">
    	<div class="homepage_post col half float_l">
            <h2>WWF In Pakistan</h2>
            <div class="post_meta"> </div>
            <h5><em>WWF - P Projects</em></h5><br />
 <p><em>Our projects are innovative, collaborative and based on scientific evidence. And we think big. We run a number of Global initiatives focussing on the regions and challenges where we can make the biggest difference - from the Arctic and the Amazon to responsible fishing</em></p>
 <ul class="templatemo_list">
            	 <?php while ($row_showprojects = mysql_fetch_assoc($showprojects)) { ?>
                <li class="flow"><?php echo $row_showprojects['proj_name']; ?></li>
                   <?php }  ?>
               
			</ul>
         </div>
        <div id="news">
         <h2>News  & Updates</h2>
         <div id="container">

  <div class="newsitem">
  
   <marquee  behavior="scroll" direction="up" scrollamount="2" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 2, 0)"; >
 <?php while ($row_news = mysql_fetch_assoc($news)){?>
    <h3><?php echo $row_news['n_title']; ?><br />
<span><br />
<?php echo date('d-m-Y',strtotime($row_news['n_date'])); ?></span></h3>
   <br />

    <p><?php echo $row_news['n_desc']; ?> </p>
  <?php } ; ?>
  </marquee>
 
  </div>
  

</div>
</div>

          <div class="cleaner h40"></div>
        <div class="">

	 <h2> About Chilghoza</h2>
        <div class="post_meta"> </div>
			<p><em>The trees are 10-20(-25) m tall with usually deep, wide and open crowns with long, erect branches. However, crowns are narrower and shallower in dense forests. The bark is very flaky, peeling to reveal light greyish-green patches, similar to the closely related Lacebark Pine (Pinus bungeana). </em></p> 
			<p>The edible seeds of pines are called pine nuts. There are about 20 species of pine that produce edible seeds suitable for human consumption. Amongst all, "Chilghoza", also known as "Neja" .</p>
            <ul class="templatemo_list">
            	<li class="flow">Pine kernels are indeed very good source of plant derived nutrients</li>
                <li class="flow">Chilghoza is a boon for all those who wish to reduce weight fast or are on dieting.</li>
                <li class="flow">Chilghoza is the only nut with highest concentration of oleic acid</li>
                <li class="flow">Chilghozas' contain the same mono-saturated fats as in olive oil and are very good for heart.</li>
                <li class="flow">Chilghoza also serves as a good antioxidant that protects the cells from damage due to free radicals</li>
                <li class="flow">Chilghozas' are a rich source of iron that boosts hemoglobin level of the blood.</li>
             
			</ul>
    
    
    	</div>
        
     
        
        <div class="cleaner h40"></div>
        
        <div id="food-gallery">
            <h2>Food Gallery</h2>
            <div class="col one_fourth">
                <img src="images/111.jpg" alt="Image 02" height="150" width="180" class="imgage-with-frame" />
                <p>Pignoli Nuts, also known as pine nuts, are the seeds of the stone pine, and are used in a wide variety of Italian dishes.</p>
            </div>
			
            <div class="col one_fourth fp_rw">
                <img src="images/222.jpg" alt="Image 03" class="imgage-with-frame" />
               
                <p>Contains many nutrients including vitamins E, B3, B1, and B2, essential amino acids, beta-carotene, copper</p>
            </div>
			
            <div class="col one_fourth fp_rw">
                <img src="images/444.jpg" alt="Image 04" class="imgage-with-frame" />
                <p>Raw Pine Nuts (8 oz. Bag) from Superior Nuts. Superior was founded over 80 years ago on the premise of fresh quality nuts.</p>
            </div>
			
            <div class="col one_fourth fp_rw no_margin_right">
                <img src="images/555.jpg" alt="Image 05" height="140" width="170" class="imgage-with-frame" />                
                <p>Our products are made of the finest quality ingredients provided by nature..</p>
            </div>
		</div>
                
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main_wrapper -->
</div> <!-- END of templatemo_main -->

<div id="templatemo_footer_wrapper">
	<div id="templatemo_footer">
    	Copyright © 2013 <a href="login.php">chalgoze</a> | </div> 
	<!-- END of templatemo_footer -->
</div> <!-- END of templatemo_footer_wrapper -->

</body>
</html>
<?php
mysql_free_result($showprojects);

mysql_free_result($news);
?>
