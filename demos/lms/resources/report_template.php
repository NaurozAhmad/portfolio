
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
<link rel="stylesheet" href="../themes/default/default.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="../themes/styles.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../themes/nivo-slider.css" type="text/css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>LMS ICUP</title>
<meta name="description" content="Education website">
<meta name="keywords" content="education, learning, teaching">
<script>
function printpage()
  {
 document.getElementById('abc').style.display='none';
   window.print();
   setTimeout(function () {document.getElementById('abc').style.display='block'}, 10);
  }
</script>

</head>
<center>
<body>
<div id="page">
<div id="top">
	<div id="logo"><img src="../images/logo.png" width="94" height="69" alt=""></div>
     <div id="company_name">Library Management System</div>
     <div id="log"><?php $datee=date('d-m-Y');
					
	
	echo date('d-M-Y',strtotime($datee));?>

    
    </div>
    <div>
    </div>
</div>
<div id="menu"></div>
<br/>

    <div id="report">
    
    	<input type="button" value="Print this page" onClick="printpage()">
    </div>
    <div class="bottom"></div>
    </div>
	</div>  
    </div>
</div>
<div id="footer">
	<div class="top"></div>
	<div id="bottom_menu"></div>
  
    <div class="bot"></div>
</div>
</div>
</body>
</center>
</html>
