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


 
$validated_form=array("jpeg","jpg","JPG","JPEG");
	if(isset($_POST['upload']))
	{
		 $pic=$_FILES['file']['name'];
		  $title=$_POST['title'];
		   $description=$_POST['description'];
		   $uploadedby=$_POST['uploadedby'];
		  
		 if($pic!="")
		 {
		 list($filename,$ext)=explode(".",$pic);}
		 
		 $tmp=$_FILES['file']['tmp_name'];	
		
		if($pic!="")
		{
			if(in_array($ext,$validated_form))
			{
				if(file_exists("projectpics/".$pic))
				{
				$pic=$pic."_".time()."_".$pic;
				}
				$dir="projectpics/".$pic;
				if(move_uploaded_file($tmp,$dir))
				{
mysql_select_db($database_connection, $connection);
				 mysql_query("INSERT INTO `projects` VALUES('','$title','$pic','$description','$uploadedby')") or die(mysql_error());		
				}
			}
			else
			{
				echo "Only JPEG AND JPG ARE ALLOWED";
			}	
		}
		else{
			echo "please Select a file";
		}
				
	}
	
	mysql_select_db($database_connection, $connection);
$query_projects = "SELECT * FROM projects";
$projects = mysql_query($query_projects, $connection) or die(mysql_error());
//$row_projects = mysql_fetch_assoc($projects);
$totalRows_projects = mysql_num_rows($projects);
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
	color: #900;
	text-align: center;
}
tr {
	text-align: center;
}
</style>
</head>

<body>
<a href="<?php echo $logoutAction ?>">Log out</a>
<h4><span style="text-align: center"><a href="admin.php">Home</a> --- <a href="users.php">Users</a> -- <a href="news.php">News</a> -- <a href="pics.php">Gallery</a> -- <a href="contactadmin.php">Inbox</a> -- <a href="projects.php">Projects</a></span></h4>
<h1>Insert All Projects Details Here.... </h1>
<p>&nbsp;</p>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="345" border="1" align="center">
    <tr>
      <td width="83">Title</td>
      <td width="246"><label for="title"></label>
      <input name="title" type="text" id="title" size="34" /></td>
    </tr>
    <tr>
      <td colspan="2"><p>
        <label for="file"></label>
        Please Select File</p>
        <p>
          <input type="file" name="file" id="file" />
      </p></td>
    </tr>
    <tr>
      <td>Descriptop</td>
      <td><label for="Description"></label>
        <label for="description"></label>
      <textarea name="description" cols="34" rows="4" id="description"></textarea></td>
    </tr>
    <tr>
      <td>Uploaded By</td>
      <td><label for="uploadedby"></label>
      <input name="uploadedby" type="text" id="uploadedby" size="34" /></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" name="upload" id="upload" value="Upload" /></td>
    </tr>
  </table>
</form>
<h3><br />
  
  All Projects Details Are...
</h3>
<p>&nbsp;</p>
<table width="900" border="1" align="center">
  <tr>
    <td width="73">S.No</td>
    <td width="138">Title</td>
    <td width="443">Description</td>
    <td width="108">Author Name</td>
    <td width="108">Actions</td>
  </tr>
  <?php 
  $i=1;
  while ($row_projects = mysql_fetch_assoc($projects)) { ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $row_projects['proj_name']; ?></td>
      <td><?php echo $row_projects['p_desc']; ?></td>
      <td><?php echo $row_projects['proj_author']; ?></td>
      <td><a href="del_projects.php?did=<?php echo $row_projects['proj_id']; ?>">Delete Project</a></td>
    </tr>
    <?php  $i++;}  ?>
</table>
</body>
</html>
<?php
mysql_free_result($projects);
?>
