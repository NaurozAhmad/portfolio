<?php require_once('../Connections/connection.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "librarian,admin";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain user based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain user based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
		 $datee=date('y-m-d',strtotime($_POST['b_date']));

	
  $updateSQL = sprintf("UPDATE books SET scat_id=%s, b_title=%s, b_author=%s, b_condition=%s, b_date=%s, b_volume=%s, b_year=%s, b_assection=%s, b_issn=%s WHERE b_id=%s",
                       GetSQLValueString($_POST['scat_id'], "int"),
                       GetSQLValueString($_POST['b_title'], "text"),
                       GetSQLValueString($_POST['b_author'], "text"),
                       GetSQLValueString($_POST['b_condition'], "text"),
                       GetSQLValueString($datee, "date"),
                       GetSQLValueString($_POST['b_volume'], "text"),
                       GetSQLValueString($_POST['b_year'], "text"),
                       GetSQLValueString($_POST['b_assection'], "text"),
                       GetSQLValueString($_POST['b_issn'], "text"),
                       GetSQLValueString($_POST['b_id'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());

	
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$ccat=$_GET['cat'];
  $updateGoTo = "show_books.php?id=$id&ccat=$ccat";
}
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if(isset($_GET['uid']))
{
	$uid=$_GET['uid'];
mysql_select_db($database_connection, $connection);
$query_upd_books = "SELECT * FROM books where b_id=$uid";
$upd_books = mysql_query($query_upd_books, $connection) or die(mysql_error());
$row_upd_books = mysql_fetch_assoc($upd_books);
$totalRows_upd_books = mysql_num_rows($upd_books);
}

if(isset($_GET['cat']))
{
	$cat=$_GET['cat'];
	}
mysql_select_db($database_connection, $connection);
$query_sub_cat = "SELECT * FROM sub_category where cat_id=$cat";
$sub_cat = mysql_query($query_sub_cat, $connection) or die(mysql_error());
$row_sub_cat = mysql_fetch_assoc($sub_cat);
$totalRows_sub_cat = mysql_num_rows($sub_cat);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
<link rel="stylesheet" href="../themes/default/default.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="../themes/styles.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../themes/nivo-slider.css" type="text/css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Update Here...</title>
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
<div id="log"><a href="<?php echo $logoutAction ?>">Log out</a></div>
<br/>
<div id="contentwrap">
	<div id="sidebar" align="left">
    <h2>Menu</h2>
    <div class="content">
    <a href="../home.php"><h3>Home</h3></a>
    <a href="../category/category.php"><h3>Categories</h3></a>
    <a href="../sub_category/sub_category.php"><h3>Sub Categories</h3></a>
    <a href="../books/books.php"><h3>Books</h3></a>
    <a href="../staff/staff.php"><h3>Staff</h3></a>
      <a href="../students/students.php"><h3>Students</h3></a>
    <a href="../user/user.php"><h3>user</h3></a> <a href="../reports/reports.php"><h3>Reports</h3></a>
    </div>
    </div>
    <div id="data">
    	 <h2>Update Book Here..</h2>
         <form method="post" name="form1" action="<?php echo $editFormAction; ?>" id="form">
    <table align="center">
      <tr valign="baseline">
        <td nowrap align="right">Scat Name</td>
        <td><select name="scat_id">
          <?php 
do {  
?>
          <option value="<?php echo $row_sub_cat['scat_id']?>" <?php if (!(strcmp($row_sub_cat['scat_id'], htmlentities($row_upd_books['scat_id'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_sub_cat['scat_name']?></option>
          <?php
} while ($row_sub_cat = mysql_fetch_assoc($sub_cat));
?>
        </select></td>
      <tr>
      <tr valign="baseline">
        <td nowrap align="right">Title</td>
        <td><input type="text" name="b_title" value="<?php echo htmlentities($row_upd_books['b_title'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Author</td>
        <td><input type="text" name="b_author" value="<?php echo htmlentities($row_upd_books['b_author'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Condition</td>
        <td><input type="text" name="b_condition" value="<?php echo htmlentities($row_upd_books['b_condition'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Date</td>
        <td><input type="text" name="b_date" value="<?php echo date('d-m-Y',strtotime($row_upd_books['b_date'])); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Volume</td>
        <td><input type="text" name="b_volume" value="<?php echo htmlentities($row_upd_books['b_volume'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Year</td>
        <td><input type="text" name="b_year" value="<?php echo htmlentities($row_upd_books['b_year'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Assection:</td>
        <td><input type="text" name="b_assection" value="<?php echo htmlentities($row_upd_books['b_assection'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">ISSN</td>
        <td><input type="text" name="b_issn" value="<?php echo htmlentities($row_upd_books['b_issn'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">&nbsp;</td>
        <td><input type="submit" value="Update record"></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1">
    <input type="hidden" name="b_id" value="<?php echo $row_upd_books['b_id']; ?>">
  </form>
  <p>&nbsp;</p>

    
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
mysql_free_result($upd_books);

mysql_free_result($sub_cat);
?>
