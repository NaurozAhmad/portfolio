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
<?php require_once('../Connections/connection.php'); ?>
<?php 
	if(isset($_GET['uid']))
	{
		$id=$_GET['id'];
		$uid=$_GET['uid'];
		mysql_select_db($database_connection, $connection);
		$qry=mysql_query("SELECT * FROM `students` WHERE `st_id`='$uid'") or die(mysql_error());
		$prow=mysql_fetch_array($qry);
		$old_pic=$prow['p_name'];
	}


?>
<?php 
	if(isset($_POST['update']))
	{	
		    $name=$_POST['st_name'];
			$fname=$_POST['st_fname'];
			$contact=$_POST['st_contact'];
			$regno=$_POST['regno'];
			$address=$_POST['address'];
			
		$validated_form=array("jpeg","jpg");
		$dir="pics/";		
		$pic=$_FILES['pic']['name'];
		if($pic!="")
		{list($filename,$ext)=explode(".",$pic);}
		
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
				mysql_query("UPDATE `students` SET `p_name`='$pic',`st_name`='$name',`st_fname`='$fname',`st_contact`='$contact',`st_regno`='$regno',`st_address`='$address' where `st_id`='$uid'") or die(mysql_error());

	header("Location:student_detail.php?id=$id");
		
	}


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

<link href="../css/table.css" rel="stylesheet" type="text/css">
</head>

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
    <a href="../staff/staff.php"><h3>Staff</h3></a> <a href="students.php"><h3>Students</h3></a> <a href="../user/user.php"><h3>user</h3></a> <a href="../reports/reports.php"><h3>Reports</h3></a>
    </div>
    </div>
    <center>

   <div id="data">
	  <h2>Staff Information</h2>
      <h3>&nbsp;</h3>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="584" height="416" border="1" align="center">
    <tr>
      <td colspan="3"><div align="center">
        <h2><strong>Update Record here</strong></h2>
      </div></td>
    </tr>
    <tr>
      <td height="38" align="center" valign="middle">Name</td>
      <td><label for="st_name"></label>
        <input type="text" name="st_name" id="st_name" value="<?php echo $prow['st_name'];?>"></td>
      <td rowspan="5"><p><img src="pics/<?php echo $prow['p_name'];?>" height="199" width="208"/></p></td>
    </tr>
    <tr>
      <td height="38"><p>Father Name</p></td>
      <td height="38"><p>
        <label for="st_fname"></label>
          <input type="text" name="st_fname" id="st_fname" value="<?php echo $prow['st_fname'];?>">
        </p></td>
    </tr>
    <tr>
      <td height="38"><p>Contact no</p></td>
      <td height="38"><p>
        <label for="st_contact"></label>
          <input type="text" name="st_contact" id="st_contact" value="<?php echo $prow['st_contact'];?>">
        </p></td>
    </tr>
    <tr>
      <td height="29"><p>Reg-No</p></td>
      <td height="29"><p>

        <label for="regno"></label>
          <input type="text" name="regno" id="regno" value="<?php echo $prow['st_regno'];?>">
        </p></td>
    </tr>
    <tr>
      <td height="29">Address</td>
      <td height="29"><label for="address"></label>
        <textarea name="address" cols="24" rows="3" id="address" ><?php echo $prow['st_address'];?></textarea></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
      <td><label>
        <input name="pic" type="file" id="pic" />
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><label>
        <div align="center">
          <input name="update" type="submit" id="update" value="Update" />
          </div>
      </label></td>
    </tr>
  </table>
</form>
    </div>
    <div class="bottom"></div>
   

</div>
<div id="footer">
	<div class="top"></div>
	<div id="bottom_menu"></div>
    <div id="bottom_addr">© 2013 Company Name. All Rights Reserved</div>
    <div class="bot"></div>
</div>

</body>
</center>
</html>
