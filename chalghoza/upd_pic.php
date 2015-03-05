<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current users. **
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
	
  $logoutGoTo = "login.php?logoutsuccessful";
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
$MM_authorizedUsers = "admin,entry";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a users is NOT logged in if that Session variable is blank. 
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
	if(isset($_GET['uid']))
	{
		$uid=$_GET['uid'];
mysql_select_db($database_connection, $connection);
		$qry=mysql_query("SELECT * FROM `pics` WHERE `p_id`='$uid'") or die(mysql_error());
		$prow=mysql_fetch_array($qry);
		$old_pic=$prow['p_name'];
	}


?>
<?php 
	if(isset($_POST['update']))
	{	
		$validated_form=array("jpeg","jpg","JPG","JPEG");
		$dir="pics/";		
		$pic=$_FILES['pic']['name'];
		if($pic!="")
		{list($filename,$ext)=explode(".",$pic);}
		$size=$_FILES['pic']['size'];
		$type=$_FILES['pic']['type'];
		 $title=$_POST['title'];
		$tmp_pic=$_FILES['pic']['tmp_name'];
		if($pic!="")
		{
			if($old_pic!="")
			{
				if(file_exists($dir.$old_pic))
				{
					unlink($dir.$old_pic);
				}
			}
				if(file_exists($dir.$pic))
				{
				$pic=$pic."_".time()."_".$pic;
				}
				$fdir=$dir.$pic;
				move_uploaded_file($tmp_pic,$fdir);
			}
			if($pic=="")
			{
				$pic=$old_pic;
			}
mysql_select_db($database_connection, $connection);
				mysql_query("UPDATE `pics` SET `p_name`='$pic',`p_size`='$size',`p_type`='$type',`p_title`='$title' where `p_id`='$uid'") or die(mysql_error());

	header("Location:pics.php?Msg=PIC UPDATED");
		
	}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><img src="images/update.png" /></title>
<style type="text/css">
<!--
.style1 {color: #9900FF}
-->
</style>
</head>

<body>

<h1 align="center" class="style1">Update your Pics Here... </h1>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="255" height="148" border="1" align="center">
    <tr>
      <td width="245"><div align="center">
        <h2><strong>PICTURE</strong></h2>
      </div></td>
    </tr>
    <tr>
      <td>&nbsp;<img src="pics/<?php echo $prow['p_name'];?>" height="300" width="300"/></td>
    </tr>
    <tr>
      <td><label>
        <input name="pic" type="file" id="pic" />
      </label></td>
    </tr>
    <tr>
      <td><p>  Title of the Image 
      <label for="title"></label>
      <input name="title" type="text" id="title" size="30" value="<?php echo $prow['p_title'];?>" />
    </p></td>
    </tr>
    <tr>
      <td><label>
        <div align="center">
          <input name="update" type="submit" id="update" value="Update" />
          </div>
      </label></td>
    </tr>
  </table>
</form>
<a href="<?php echo $logoutAction ?>">Log out</a>
</body>
</html>
