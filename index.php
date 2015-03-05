<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="include/hash.png" />
    <title>HashDevs</title>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="menu/rmm-css/responsivemobilemenu.css"/>
    <link rel="stylesheet" type="text/css" href="css/scrolling-nav.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link rel="stylesheet" type="text/css" href="css/slider.css">
    <link rel="stylesheet" type="text/css" href="css/main-slider.css">

    <link href='http://fonts.googleapis.com/css?family=Exo+2|Oxygen|Alegreya+Sans+SC|Raleway:200|Poiret+One|Courgette' rel='stylesheet' type='text/css'>

</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<!--Logo -->
    <?php require_once('nav.php') ?>

<!--Banner-->
    <div class="banner">
    	<div class="row">
    		<h1 class="cust-banner-h1">#Devs</h1>
    		<p class="cust-intro-p">Much Development. So Wow.</p>
    	</div>
    </div>
    

    <div class="container">
    	<div class="cust-our-div">
            <h1 class="cust-work cust-our-h1">WHAT WE DO</h1>
            <p class="cust-work-p">Awesome Web Design and Web App Solutions!</p>
            
        </div>
    	<div class="row cust-our-container">
    		<div class="cust-our-part col-md-6 col-xs-6">
                <h4 class="cust-our-p">#Web Design</h4>
     			<p class="cust-our-p"><img src="img/ios.jpg" alt=""></p>
                <p class="cust-our-para">Creative Web Designs using the latest tools for responsive layout.</p>
                <p class="cust-our-p"><a href="#" class="btn btn-cust btn-block">Learn how we work.</a></p>
            </div>
            <div class="col-md-6 col-xs-6">
                <h4 class="cust-our-p">#Web Apps</h4>
                <p class="cust-our-p"><img src="img/pad.jpg" alt=""></p>
                <p class="cust-our-para">Small and Large Scale Web Applications for NGO's and Government Sectors.</p>
                <p class="cust-our-p"><a href="#" class="btn btn-cust btn-block">Learn how we work.</a></p>
            </div>
    	</div>
        
    </div>

    <h1 class="portfolio-banner page-scroll" id="portfolio">Portfolio</h1>

    <div class="main-slider"><?php require_once'slider.php'; ?></div>
    
    <?php require_once('thumbnail-gallery.php'); ?>

    <h1 class="portfolio-banner page-scroll" id="contact">
        Get In Touch
    </h1>

    <?php require_once('contact.php'); ?>
    

<!--===========================================================================================================Footer-->
	<?php require_once('footer.php') ?>
	

    <!--======================================================================================================= Bootstrap files -->
	<script src="js/jquery-1.11.0.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/scrolling-nav.js"></script>
    <script src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>



    
    
    <script type="text/javascript">
        var t = $("#anchor-top").offset().top;
        $(document).scroll(function(){
            if($(this).scrollTop() > 10)
            {   
                $('.logo').css({"width":"4%"});
                $('.logo').css({"margin-left":"48.5%"});
                $('.nav').css({"margin-top":"15px"});
                $('.nav').css({"font-size":"12px"});
                
            }
            else {
                $('.logo').css({"width":"8%"});
                $('.logo').css({"margin-left":"46.5%"});
                $('.nav').css({"margin-top":"35px"});
                $('.nav').css({"font-size":"15px"});
            }
        });
        $(document).ready(function() {
            

        // Instantiate MixItUp:

        $('#Container').mixItUp();

    });

    </script>

    <!--========================================================================================= Social Buttons Script ==================-->
    <script type="text/javascript">


        $(".fb").hover(function(){
            $(this).attr("src", function(index, attr){
                return attr.replace(".png", "-blue.png");
            }); 
        }, function(){
                $(this).attr("src", function(index, attr){
                return attr.replace("-blue.png", ".png");
            });
        }); 
        $(".tt").hover(function(){
                $(this).attr("src", function(index, attr){
                return attr.replace(".png", "-blue.png");
            });

                
        }, function(){
                $(this).attr("src", function(index, attr){
                return attr.replace("-blue.png", ".png");
            });
        });
        $(".tm").hover(function(){
                $(this).attr("src", function(index, attr){
                return attr.replace(".png", "-blue.png");
            });
                
        }, function(){
                $(this).attr("src", function(index, attr){
                return attr.replace("-blue.png", ".png");
            });
        });


    </script>
    <script type="text/javascript">
        jQuery(document).ready(function($){
          //portfolio - show link
        $('.back').hover(
            function () {
                $(this).stop(true,true);
                $(this).animate({opacity:'1'});
            },
            function () {
                $(this).stop(true,true);
                $(this).animate({opacity:'0'});
            }
          ); 
        });
    </script>

    
</body>
</html>