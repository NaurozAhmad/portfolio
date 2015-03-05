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
	
  $logoutGoTo = "login.php?logoutsuccessfully";
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
$MM_authorizedUsers = "admin";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php?loginfirst";
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
$query_users = "SELECT * FROM users";
$users = mysql_query($query_users, $connection) or die(mysql_error());
//$row_users = mysql_fetch_assoc($users);
$totalRows_users = mysql_num_rows($users);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body {
	text-align: center;
}
body {
	font-weight: bold;
}
h1 {
	color: #900;
}
strong {
	color: #900;
}
</style>
</head>

<body>
<h5><a href="admin.php">Home</a> --- <a href="users.php">Users</a> -- <a href="news.php">News</a> -- <a href="pics.php">Gallery</a> -- <a href="contactadmin.php">Inbox</a> -- <a href="projects.php">Projects</a></h5>
<h1>You can Add Delete and Update Users here
</h1>
<p><a href="ins_users.php">Insert Users</a></p>
<h2><strong>All Users Are..</strong></h2>
<p>&nbsp;</p>
<table border="1" align="center">
  <tr>
    <td>S.No</td>
    <td>Username</td>
    <td>Password</td>
    <td>Type</td>
    <td colspan="2">Actions</td>
  </tr>
  <?php  $i=1; while ($row_users = mysql_fetch_assoc($users)) { ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $row_users['username']; ?></td>
      <td><?php echo $row_users['password']; ?></td>
      <td><?php echo $row_users['type']; ?></td>
      <td><a href="upd_users.php?uid=<?php echo $row_users['uid']; ?>">Update</a></td>
      <td><a href="del_users.php?did=<?php echo $row_users['uid']; ?>">Delete</a></td>
    </tr>
    <?php $i++;}  ?>
</table>
<p>&nbsp;</p>
<p><a href="admin.php">Home</a> --- <a href="users.php">Users</a> -- <a href="news.php">News</a> -- <a href="pics.php">Gallery</a> -- <a href="contactadmin.php">Inbox</a> -- <a href="projects.php">Projects</a></p>
<a href="<?php echo $logoutAction ?>">Log out</a>
</body>
</html>
<?php
mysql_free_result($users);
?>
