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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
<link rel="stylesheet" href="../themes/default/default.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="../themes/styles.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../themes/nivo-slider.css" type="text/css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Staff Information</title>
<meta name="description" content="Education website">
<meta name="keywords" content="education, learning, teaching">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">

<link href="../css/table.css" rel="stylesheet" type="text/css">
<style type="text/css">
#page #contentwrap #data table tr td {
	text-align: center;
}
</style>
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
    <a href="staff.php"><h3>Staff</h3></a>
     <a href="../students/students.php"><h3>Students</h3></a>
    <a href="../user/user.php"><h3>user</h3></a> <a href="../reports/reports.php"><h3>Reports</h3></a>
    </div>
    </div>
    

    <div id="data">
	  <h2>Staff Information</h2>
      <table width="543" height="298" border="1" align="center">
     <tr valign="middle"><td colspan="5" align="center"> <h3><a href="ins_staff.php">Insert Staff here</a></h3></td></tr>
      
     
     
  <tr>
    <td colspan="4"><div align="center">
      <h2>Staff Detail</h2>
    </div></td>
    <td width="98"><h2>Actions</h2></td>
  </tr>
 <?php
 mysql_select_db($database_connection, $connection); 
 $qry=mysql_query("SELECT * FROM `staff`");?> 
 <?php $i=1; 
 	while($prow=mysql_fetch_array($qry))
	{ 
 ?> 
  <tr><td width="61" rowspan="4">&nbsp;<?php echo $i; ?></td>
    <td width="91"><strong>Name</strong></td>
    <td width="120"><em>&nbsp;<?php echo $prow['staff_name'];?></em></td>
    <td width="139" rowspan="4">&nbsp;<img src="pics/<?php echo $prow['p_name'];?>" height="152" width="120" /></td>
    
    <td rowspan="3"><div align="center">
      <h3><strong><a href="upd_staff.php?uid=<?php echo $prow['staff_id'];?>">Update</a></strong></h3>
    </div></td>
  </tr>
  <tr>
    <td><strong>Father Name</strong></td>
    <td><em>&nbsp;<?php echo $prow['staff_fname'];?></em></td>
  </tr>
  <tr>
    <td><strong>CNIC</strong></td>
    <td><em>&nbsp;<?php echo $prow['staff_cnic'];?></em></td>
  </tr>
  <tr>
    <td width="91" height="55"><strong>Reg-No</strong></td>
    <td width="120"><em>&nbsp; <?php echo $prow['staff_regno'];?></em></td>
    <td><div align="center">
      <h3><strong><a href="del_staff.php?did=<?php echo $prow['staff_id'];?>">Delete</a></strong></h3>
    </div></td>
  </tr>
  <?php $i++; }?>
</table>
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
<center>
</html>
