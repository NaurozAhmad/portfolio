<?php require_once('../Connections/connection.php'); ?>
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
$query_categories = "SELECT * FROM category";
$categories = mysql_query($query_categories, $connection) or die(mysql_error());
//$row_categories = mysql_fetch_assoc($categories);
$totalRows_categories = mysql_num_rows($categories);
?> 
<script type="text/javascript" src="../jQuery/jquery.js"></script>
<script type="text/javascript" src="../jQuery/insert_form.js"></script>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
<link rel="stylesheet" href="../themes/default/default.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="../themes/styles.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../themes/nivo-slider.css" type="text/css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>LMS ICUP</title>
<meta name="description" content="Education website">
<meta name="keywords" content="education, learning, teaching">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">

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
<div id="contentwrap">
	<div id="sidebar" align="left">
    <h2>Menu</h2>
    <div class="content">
    <a href="../home.php"><h3>Home</h3></a>
   <a href="catbooks_para.php"><h3>Category Books</h3></a>
     <a href="subcatbooks_para.php"><h3>Subcategory Books</h3></a>
     <a href="students.php"><h3>Students</h3></a>
      <a href="mainreport.php"><h3>Main Report</h3></a>
    </div>
    </div>
    <div id="data">
    	 <h2>Select Category to Generate Report</h2>
    
        <form method="post" name="form1" action="cat_books.php" >
Category :
          <select name="cat_id"  id="cat_id">
          <option value="-" >Select Catagory </option>
              <?php
while ($row_categories = mysql_fetch_assoc($categories)) {  
?>
              <option value="<?php echo $row_categories['cat_id']?>"><?php echo $row_categories['cat_name']?></option>
              <?php
} 
 
?>
          </select><br>

      <div id="result"></div>
      <br />
      <input type="submit" name="ssubmit" id="submit" value="Submit">
        </form>
    </div>
    <div class="bottom"></div>
    </div>
	</div>  
    </div>
</div>
<div id="footer">
	<div class="top"></div>
	<div id="bottom_menu"></div>
    <div id="bottom_addr">© 2013 Company Name. All Rights Reserved</div>
    <div class="bot"></div>
</div>
</div>
</body>
</center>
</html>
<?php
mysql_free_result($categories);
?>
