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
if(isset($_GET['id']))
{
$id=$_GET['id'];
mysql_select_db($database_connection, $connection);
$query_student_detail = "SELECT * FROM students where st_id=$id";
}
$student_detail = mysql_query($query_student_detail, $connection) or die(mysql_error());
$row_student_detail = mysql_fetch_assoc($student_detail);
$totalRows_student_detail = mysql_num_rows($student_detail);

$query=mysql_query("SELECT books.*,issue.start_date,issue.issue_id from books ,issue  where books.b_id=issue.b_id and issue.st_id=$id and books.b_status=1 and issue.end_date is NULL") or die(mysql_error());
$num=mysql_num_rows($query);
?>
<!----->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
<link rel="stylesheet" href="../themes/default/default.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="../themes/styles.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../themes/nivo-slider.css" type="text/css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Students detail</title>
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
    <a href="../staff/staff.php"><h3>Staff</h3></a> <a href="students.php"><h3>Students</h3></a> 
    </div>
    </div>
    <div id="data">
   	    <h2>Student Detail</h2>
        <table border="0" align="left">
        	<tr>
            	<td width="130" height="31" align="right">Registeration No :</td>
                <td width="311" colspan="2" style="color:#F00;"><?php echo $row_student_detail['st_regno'];?></td>
                
            </tr>
        <tr>
            	<td height="26" align="right">Student Name :</td>
                <td colspan="2" style="color:#F00;" ><?php echo $row_student_detail['st_name'];?></td>
            </tr>
             <tr>
            	<td height="26" align="right">Father Name :</td>
                <td colspan="2" style="color:#F00;" ><?php echo $row_student_detail['st_fname'];?></td>
            </tr>
             <tr>
            	<td height="28" align="right">Contact No :</td>
                <td colspan="2" style="color:#F00;" ><?php echo $row_student_detail['st_contact'];?></td>
            </tr>
             <tr>
            	<td height="43" align="right">Address :</td>
                <td colspan="2" style="color:#F00;" ><?php echo $row_student_detail['st_address'];?></td>
            </tr>
             
         <tr>
         <td height="36" align="right">Actions</td>
         <td height="36" align="right"><a href="upd_student.php?uid=<?php echo $row_student_detail['st_id'];?>&id=<?php echo $id; ?>">UPDATE</a></td>
         <td height="36" colspan="2" align="right"><a href="del_student.php?did=<?php echo $row_student_detail['st_id'];?>&id=<?php echo $id;?>">DELETE</a></td>
         </tr>
        
        
        </table>
        <table align="left">
          <tr>
            <td><h3>&nbsp;</h3></td>
          </tr>
          <tr>
            <td><img src="pics/<?php echo $row_student_detail['p_name'];?>" height="200" width="150" /></td>
          </tr>
        </table>
        <br>

    <br>
<br>

    </div>

<br>

    <div id="search">
    


    	<h2>Search Books Here.. </h2>
        <br>
        
 <form name="form1" method="post" action="book_results.php" id="form2">
	    
	    <table border="1">
        <tr><td>Select Choice </td>
            <td><label for="search_type"></label>
	        <select name="search_type" id="search_type">
	          <option value="name" selected> By Author Name</option>
	          <option value="assec"  >By Assection Number</option>
              <option value="title"  >By Title</option>
              
            </select></td></tr>
<tr><td>Enter Value </td><td>
            <input type="text" name="data" ></td>
            </tr><tr>
            <td>&nbsp;</td>
<td>            <input type="submit" name="submit" value=" Search " >
				<input type="hidden" name="stid" value="<?php echo $id ;?>">
                <input type="hidden" name="num" value="<?php echo $num ;?>">
                
    </td></tr></table>      
	        <input type="hidden" name="hidden" value="hidden" >
	    </form>

    </div>

    <div id="issuedbooks">
    <br>

    	<h2>Issued Books Are..</h2>
    	<p>&nbsp;</p>
    	<p>&nbsp;</p>
        
    	<table width="443" border="1">
       
          <tr>
            <th width="34" scope="col"><strong>S.No</strong></th>
            <th width="116" scope="col"><strong>Author Name</strong></th>
            <th width="112" scope="col"><strong>Title</strong></th>
            <th width="62" scope="col"><strong>Issue Date</strong></th>
            <th width="85" scope="col"><strong>Status</strong></th>
          </tr>
          <?php $i=1; while($row_data=mysql_fetch_assoc($query)){?>
          <tr>
            <td>&nbsp;<?php echo $i;?></td>
            <td>&nbsp;<?php echo $row_data['b_author'];?></td>
            <td>&nbsp;<?php echo $row_data['b_title'];?></td>
            <td>&nbsp;<?php echo date('d-M-Y',strtotime($row_data['start_date']));?></td>
            <td><a href="return.php?bid=<?php echo $row_data['b_id'];?>&id=<?php echo $id; ?>&is=<?php echo $row_data['issue_id']; ?>">Return</a></td>
          </tr>
          <?php $i++; }?>
          <?php if($num>=4){?><tr><td colspan="5"><center><span style="color:#F00">You cannot Issue More Books..</span></center></td></tr><?php }?>
        </table>
            </div>
    <div class="bottom"></div>
    </div>

</div>  
    

<div id="footer">
	<div class="top"></div>
	<div id="bottom_menu"></div>
    <div id="bottom_addr">© 2011 Company Name. All Rights Reserved</div>
    <div class="bot"></div>
</div>

</body>
</center>
</html>
<?php
mysql_free_result($student_detail);
?>
