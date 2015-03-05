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

mysql_select_db($database_connection, $connection);
$query_staff_students = "SELECT * FROM books where b_status=1";
$staff_students = mysql_query($query_staff_students, $connection) or die(mysql_error());
//$row_staff_students = mysql_fetch_assoc($staff_students);
$totalRows_staff_students = mysql_num_rows($staff_students);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
<link rel="stylesheet" href="../themes/default/default.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="../themes/styles.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../themes/nivo-slider.css" type="text/css" media="screen" />
    <style type="text/css">
</style>
 <link href="sty.css" rel="stylesheet" type="text/css"> 

<style type="text/css">
<!--
.style6 {color: #FFFFFF}
.content td { background-color:#FFFFFF; font-size:14px}
-->


</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Reports</title>
<meta name="description" content="Education website">
<meta name="keywords" content="education, learning, teaching">

<script>
function printpage()
  {
 document.getElementById('abc').style.display='none';
   window.print();
   setTimeout(function () {document.getElementById('abc').style.display='block'}, 10);
  }
</script>
</head>

<center>
<body>
<div id="page">
<div id="top">
	<div id="logo"><img src="../images/logo.png" width="94" height="69" alt=""></div>
     <div id="company_name">Library Management System<br>
Islamia College & University Peshawar
</div>
     <div id="log"><?php $datee=date('d-m-Y');
					
	
	echo date('d-M-Y',strtotime($datee));?>

    
    </div>
    <div>
    </div>
</div>
<div id="menu"></div>
<br/>
<div id="report">
<table width="800" align="center" border="0" id="a">

<tr bgcolor="#FFFFFF" id="s" >
<td scope="col" colspan="9">Books Issue Detail currently Not Returned</th></td>
  <tr bgcolor="#FFFFFF" style="border-bottom:#666">
	<th scope="col">No</th> 
    
    <th scope="col">Book Author</th>
   
    <th scope="col">ASSEC No</th>
    <th scope="col">Staff Name</th>
   
    <th scope="col"></th>
    <th scope="col">Student Name</th>
    <th scope="col">Student RegNo</th>
    <th scope="col"></th>
    <th scope="col">Date</th>
   
  </tr>
  <?php $i=1; while ($row_staff_students = mysql_fetch_assoc($staff_students)) { ?>
    <?php
	
	mysql_select_db($database_connection, $connection);
	$b_id=$row_staff_students['b_id'];
	
	$query=mysql_query("SELECT * from issue i,students st,staff s,books b where s.staff_id=i.staff_id and st.st_id=i.st_id and i.b_id=$b_id and i.end_date is NULL") or die(mysql_error());
	 $data=mysql_fetch_assoc($query);
	 ?>
     
      <tr>
      <td><?php echo $i; ?></td>
    	<td><?php echo $row_staff_students['b_author']; ?></td>
      
        <td><?php echo $row_staff_students['b_assection']; ?></td>
       
        
        <td><?php echo $data['staff_name']; ?></td>
        
        <td>to </td>
        
        <td><?php echo $data['st_name']; ?></td>
    	<td><?php echo $data['st_regno']; ?></td>
        <td> On </td>
        
        <td><?php echo  date('d-m-Y',strtotime($data['start_date'])); ?></span></td>
    	
    </tr>

	<?php $i++; }  ?>
   </table>
   <div id="abc">
<div id="abc" >

<input type="button" value="Print Report" onClick="printpage()">
<a href="reports.php"><input type="button" value="Back to Reports"></a>
</div></div>
</div>
<div class="bottom"></div>
  </div>
	</div>  
    </div>
</div>
<div id="footer">
	<div class="top"></div>
	<div id="bottom_menu"></div>
  
    <div class="bot"></div>
</div>
</div>
</body>
</center>
</html><?php
mysql_free_result($staff_students);
?>
