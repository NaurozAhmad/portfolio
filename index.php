<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" type="image/png" href="_assets/_img/logo.php" />
	<title>HashDevs</title>

	<link rel="stylesheet" type="text/css" href="_assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="menu/rmm-css/responsivemobilemenu.css"/>
	<link rel="stylesheet" type="text/css" href="_assets/css/scrolling-nav.css">
	<link rel="stylesheet" type="text/css" href="_assets/css/custom.css">
	<link rel="stylesheet" type="text/css" href="_assets/css/slider.css">
	<link rel="stylesheet" type="text/css" href="_assets/css/main-slider.css">
	<link href='http://fonts.googleapis.com/css?family=Exo+2|Oxygen|Alegreya+Sans+SC|Raleway:200|Poiret+One|Courgette' rel='stylesheet' type='text/css'>

</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

	<?php require_once '_sections/nav.php' ?>

	<?php require_once '_sections/banner.php' ?>

	<?php require_once '_sections/home.php' ?>

	<?php require_once '_sections/portfolio.php' ?>

	<?php require_once '_sections/contact.php'; ?>

	<?php require_once '_sections/footer.php'; ?>

	<script type="text/javascript" src="_assets/js/jquery-1.11.0.js"></script>
	<script type="text/javascript" src="_assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="_assets/js/jquery.easing.min.js"></script>
	<script type="text/javascript" src="_assets/js/scrolling-nav.js"></script>
	<script type="text/javascript" src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>
	<script type="text/javascript" src="_assets/js/menu-scroll-animation.js"></script>
	<script type="text/javascript" src="_assets/js/footer-icons-animation.js"></script>
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
