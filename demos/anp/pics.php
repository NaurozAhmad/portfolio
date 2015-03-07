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
$validated_form=array("jpeg","jpg","JPG","JPEG");
	if(isset($_POST['upload']))
	{
		 $pic=$_FILES['file']['name'];
		 if($pic!="")
		 {
		 list($filename,$ext)=explode(".",$pic);}
		 $size=$_FILES['file']['size'];
		 $type=$_FILES['file']['type'];
		  $title=$_POST['title'];
		 $tmp=$_FILES['file']['tmp_name'];	
		
		if($pic!="")
		{
			if(in_array($ext,$validated_form))
			{
				if(file_exists("pics/".$pic))
				{
				$pic=$pic."_".time()."_".$pic;
				}
				$dir="pics/".$pic;
				if(move_uploaded_file($tmp,$dir))
				{
mysql_select_db($database_connection, $connection);
				 mysql_query("INSERT INTO `pics` VALUES('','$pic','$size','$type','$title')") or die(mysql_error());		
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
</style>
</head>

<body>
<a href="admin.php">Home</a> --- <a href="users.php">Users</a> -- <a href="news.php">News</a> -- <a href="pics.php">Gallery</a> -- <a href="contactadmin.php">Inbox</a> -- <a href="projects.php">Projects</a>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <div align="center">
    <p><span class="style1">Please Upload Your Pics Here</span>
      <input name="file" type="file" size="50" maxlength="50" />
    </p>
    <p><span class="style1">Title of the Image</span> 
      <label for="title"></label>
      <input name="title" type="text" id="title" size="50" value="" />
    </p>
    <p>
      <input name="upload" type="submit" id="upload" value="Upload" />
    </p>
  </div>
  <label></label>
  <p>
    <label></label>
  </p>
</form>


<h2>All Pics Are
  </p>
  <center>
</h2>
<table width="" align="center" border="1" id="a">
  <tr bgcolor="#FFFFFF" id="s" >
<td scope="col" colspan="2">Pics Are</th></td>
  <tr bgcolor="#FFFFFF">
    
  </tr>
 <?php 
mysql_select_db($database_connection, $connection);$qry=mysql_query("SELECT * FROM `pics`");?> 
 <?php 
 	while($prow=mysql_fetch_array($qry))
	{
 ?> 
  <tr>
    <td>&nbsp;<img src="pics/<?php echo $prow['p_name'];?>" height="200" width="300" /></td>
    <td><h1><strong><a href="del_pic.php?did=<?php echo $prow['p_id'];?>"><img src="images/delete.png" /></a></strong></h1>
    <h1> <strong><a href="upd_pic.php?uid=<?php echo $prow['p_id'];?>"><img src="images/update.png" /></a></strong></h1></td>
   
  </tr>
  <tr>
    <td colspan="2">&nbsp;<?php echo $prow['p_title'];?></td>
    
  </tr>
  <?php }?>
</table>
<p>&nbsp;<a href="<?php echo $logoutAction ?>">Log out</a></p>
</body>
</html>