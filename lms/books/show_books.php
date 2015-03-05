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
if(isset($_POST['submit']))
{
$id=$_POST['scat_id'];
$cat=$_POST['cat_id'];
}
else if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$cat=$_GET['ccat'];
	}
mysql_select_db($database_connection, $connection);
$query_all_books = "SELECT books.*,sub_category.scat_name FROM books,sub_category where sub_category.scat_id=books.scat_id and sub_category.scat_id=$id";

$all_books = mysql_query($query_all_books, $connection) or die(mysql_error());
$row_all_books = mysql_fetch_assoc($all_books);
$totalRows_all_books = mysql_num_rows($all_books);
$name=$row_all_books['scat_name']; 



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
<link rel="stylesheet" href="../themes/default/default.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="../themes/styles.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../themes/nivo-slider.css" type="text/css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Books</title>
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
    <a href="books.php"><h3>Books</h3></a>
    <a href="../staff/staff.php"><h3>Staff</h3></a>
      <a href="../students/students.php"><h3>Students</h3></a>
    <a href="../user/user.php"><h3>user</h3></a> <a href="../reports/reports.php"><h3>Reports</h3></a>
    </div>
    </div>
    <div id="data">
    	 
         <h2>  <?php echo $name; ?> Books </h2>
    <table border="1">
  <tr>
    <td><strong>S.No</strong></td>
    <td><strong>Subcat_Name</strong></td>
    <td><strong>Title</strong></td>
    <td><strong>Author</strong></td>
    <td><strong>Date</strong></td>
    <td><strong>Volume</strong></td>
    <td><strong>Assection</strong></td>
    <td><strong>ISSN</strong></td>
    <td colspan="2"><strong>Actions</strong></td>
    
  </tr>
  <?php $i=1;  do{ ?>
    <tr>
   
      <td><?php echo $i; ?></td>
      <td><?php echo $row_all_books['scat_name']; ?></td>
      <td><?php echo $row_all_books['b_title']; ?></td>
      <td><?php echo $row_all_books['b_author']; ?></td>

      <td><?php echo date('d-m-Y',strtotime($row_all_books['b_date'])); ?></td>
      <td><?php echo $row_all_books['b_volume']; ?></td>

      <td><?php echo $row_all_books['b_assection']; ?></td>
      <td><?php echo $row_all_books['b_issn']; ?></td>
      <td><a href="upd_books.php?uid=<?php echo $row_all_books['b_id']; ?>&id=<?php echo $id; ?>&cat=<?php echo $cat; ?>">Update</a></td>
      <td><a href="del_books.php?did=<?php echo $row_all_books['b_id']; ?>&id=<?php echo $id; ?>">Delete</a></td>
    </tr>
    <?php $i++; }while ($row_all_books = mysql_fetch_assoc($all_books)) ; 
	
	 ?>
    
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
<?php
mysql_free_result($all_books);


?>
