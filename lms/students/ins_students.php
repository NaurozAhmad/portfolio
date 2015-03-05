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
$validated_form=array("jpeg","jpg");
	if(isset($_POST['upload']))
	{	
		 $regno=$_POST['st_regno'];
		 $name=$_POST['st_name'];
		 $fname=$_POST['st_fname'];
		 $contact=$_POST['st_contact'];
		 $address=$_POST['st_address'];
		 
		 $pic=$_FILES['file']['name'];
		 if($pic!="")
		 {
		 list($filename,$ext)=explode(".",$pic);}
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
				 mysql_query("INSERT INTO `students` VALUES('','$regno','$name','$fname','$contact','$address','$pic')") or die(mysql_error());		
				 header("Location:students.php");
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

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
<link rel="stylesheet" href="../themes/default/default.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="../themes/styles.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../themes/nivo-slider.css" type="text/css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Insert Students</title>
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
    <a href="../staff/staff.php"><h3>Staff</h3></a> <a href="students.php"><h3>Students</h3></a> <a href="../user/user.php"><h3>user</h3></a> <a href="../reports/reports.php"><h3>Reports</h3></a>
    </div>
    </div>
    <div id="data">
   	    <h2>Content Area</h2>
     
      <form action="" method="post" enctype="multipart/form-data" name="form1" id="form">
  <table border="1">
  
  <p>&nbsp;</p>
  <div align="center">
    <tr>
      <td width="106">Reg-No</td>
      <td width="275"><label for="st_regno"></label>
        <input type="text" name="st_regno" id="st_regno"></td>
    </tr>
    <tr>
      <td> Name</td>
      <td><label for="st_name"></label>
        <input type="text" name="st_name" id="st_name"></td>
    </tr>
    <tr>
      <td>Father Name</td>
      <td><label for="st_fname"></label>
        <input type="text" name="st_fname" id="st_fname"></td>
    </tr>
    <tr>
      <td>Contact No</td>
      <td><label for="st_contact"></label>
        <input type="text" name="st_contact" id="st_contact"></td>
    </tr>
    <tr>
      <td valign="top">Address</td>
      <td><p>
        <label for="st_address"></label>
        </p>
        <p>
          <textarea name="st_address" id="st_address" cols="25" rows="3"></textarea>
        </p></td>
    </tr>
    <tr><td colspan="2"><p>Please Upload Pic here..
      </p>
        <p>&nbsp;</p>
        <p>
          <input name="file" type="file" size="50" maxlength="50" />
        </p></td>
    
    </tr>
    
    <tr><td colspan="2"><input name="upload" type="submit" id="upload" value="Upload" /></td>
    </tr>
    
  </div>
  <label></label>
  <p>
    <label></label>
  </p>
</form></table>
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
