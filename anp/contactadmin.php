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
$per_page=10;
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
$query_data = "SELECT * FROM contact ORDER BY c_id DESC LIMIT $start,$per_page  ";
$t_query=mysql_query("SELECT * FROM contact") or die(mysql_error());
$t_no=mysql_num_rows($t_query);
 $noof_pages= ceil($t_no/$per_page);


$data = mysql_query($query_data, $connection) or die(mysql_error());
//$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ayubia National Park</title>
  
 
    
  
   
   

      

<style type="text/css">
p {
	text-align: center;
	font-weight: bold;
}
h1 {
	text-align: center;
	color: #900;
}
h5 {
	text-align: center;
}
</style>
</head>
<body>

                    
        <h4 style="text-align: center"><a href="admin.php">Home</a> --- <a href="users.php">Users</a> -- <a href="news.php">News</a> -- <a href="pics.php">Gallery</a> -- <a href="contactadmin.php">Inbox</a> -- <a href="projects.php">Projects</a>------- <a href="<?php echo $logoutAction ?>">Log out</a></h4>
        <h1>Inbox Messages Are..
          </th>
        </h1>
        <center>
            <table width="800" align="center" border="2" id="a">
<tr bgcolor="#FFFFFF" id="s" >
<td scope="col" colspan="5">&nbsp;</td>
  <tr bgcolor="#FFFFFF">
    <td><b>S.No</b></td>
    <td><b>Name</b></td>
    <td><b>Email</b></td>
    <td><b>Date</b></td>
    <td>Actions</td>
  </tr>
  <?php
  
   
			
			if(isset($_GET['page']))
			{
				$i=($_GET['page']-1)*($per_page)+1;
				}
				else
				{
					$i=1; 
	
					}
   while ($row_data = mysql_fetch_assoc($data)) { ?>
    <tr>
      <td><a href="message.php?id=<?php echo $row_data['c_id']; ?>"><?php echo $i; ?></a></td>
      <td><a href="message.php?id=<?php echo $row_data['c_id']; ?>"><?php echo $row_data['c_author']; ?></a></td>
      <td><a href="message.php?id=<?php echo $row_data['c_id']; ?>"><?php echo $row_data['c_sender']; ?></a></td>
      <td><a href="message.php?id=<?php echo $row_data['c_id']; ?>"><?php echo $row_data['date']; ?></a></td>
      <td><a href="del_message.php?did=<?php echo $row_data['c_id']; ?>"><img src="images/delete.png" /></a></td>
    </tr>
    <?php $i++;}  ?>
</table>
</center>
<br />
<center>
<?php if($noof_pages>1){?>
<a href="contactadmin.php?page=1">Home </a> :
<?php
}
			for($i=1;$i<=$noof_pages;$i++) {
            
						
                 echo '<a href="contactadmin.php?page='.$i.'">'.$i.'</a>&nbsp;&nbsp;'; } ?>
<?php if($noof_pages>1){?>
<a href="contactadmin.php?page=<?php echo $noof_pages;?>">Last</a> <?php }?>
</center>

        
</body>
</html>
<?php
mysql_free_result($data);
?>
