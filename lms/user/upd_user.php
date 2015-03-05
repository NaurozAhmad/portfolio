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
  $updateSQL = sprintf("UPDATE user SET username=%s, password=%s, type=%s, staff_id=%s WHERE `uid`=%s",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['staff_id'], "int"),
                       GetSQLValueString($_POST['uid'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());

  $updateGoTo = "user.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
if(isset($_GET['uid'])){
	$uid=$_GET['uid'];
	
mysql_select_db($database_connection, $connection);
$query_upd_users = "SELECT * FROM user where uid=$uid";
$upd_users = mysql_query($query_upd_users, $connection) or die(mysql_error());
$row_upd_users = mysql_fetch_assoc($upd_users);
$totalRows_upd_users = mysql_num_rows($upd_users);
}
mysql_select_db($database_connection, $connection);
$query_staff = "SELECT * FROM staff";
$staff = mysql_query($query_staff, $connection) or die(mysql_error());
$row_staff = mysql_fetch_assoc($staff);
$totalRows_staff = mysql_num_rows($staff);
?>
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
    <a href="user.php"><h3>user</h3></a> <a href="../reports/reports.php"><h3>Reports</h3></a>
    </div>
    </div>
    <div id="data">
    	 <h2>Update Users Here</h2>
    <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Username:</td>
      <td><input type="text" name="username" value="<?php echo htmlentities($row_upd_users['username'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Password:</td>
      <td><input type="text" name="password" value="<?php echo htmlentities($row_upd_users['password'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Type:</td>
      <td><input type="text" name="type" value="<?php echo htmlentities($row_upd_users['type'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Staff Name</td>
      <td><select name="staff_id">
        <?php 
do {  
?>
        <option value="<?php echo $row_staff['staff_id']?>" <?php if (!(strcmp($row_staff['staff_id'], htmlentities($row_upd_users['staff_id'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_staff['staff_name']?></option>
        <?php
} while ($row_staff = mysql_fetch_assoc($staff));
?>
      </select></td>
    <tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="uid" value="<?php echo $row_upd_users['uid']; ?>">
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
mysql_free_result($upd_users);

mysql_free_result($staff);
?>
