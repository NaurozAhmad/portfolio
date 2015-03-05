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
$cat=$_POST['cat_id'];
mysql_select_db($database_connection, $connection);
$query_cat_books = "SELECT *  FROM books,category,sub_category WHERE category.cat_id= sub_category.cat_id  AND sub_category.scat_id=books.scat_id and category.cat_id=$cat";
$cat_books = mysql_query($query_cat_books, $connection) or die(mysql_error());
$row_cat_books = mysql_fetch_assoc($cat_books);
$totalRows_cat_books = mysql_num_rows($cat_books);
}

if(isset($_POST['ssubmit']))
{
$cat=$_POST['cat_id'];
$scat_id=$_POST['scat_id'];
mysql_select_db($database_connection, $connection);
$query_cat_books = "SELECT *  FROM books,category,sub_category WHERE category.cat_id= sub_category.cat_id  AND sub_category.scat_id=books.scat_id and category.cat_id=$cat AND sub_category.scat_id=$scat_id";
$cat_books = mysql_query($query_cat_books, $connection) or die(mysql_error());
$row_cat_books = mysql_fetch_assoc($cat_books);
$totalRows_cat_bookss = mysql_num_rows($cat_books);
}

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
<center></center>
 <?php if(isset($_POST['submit']) && $totalRows_cat_books>0)
 {
 ?>
<table width="800" align="center" border="0" id="a">
<tr bgcolor="#FFFFFF" id="s" >
<td scope="col" colspan="10"><?php echo $row_cat_books['cat_name']; ?></th></td>
  <tr bgcolor="#FFFFFF" style="border-bottom:#666">
	<th scope="col">S.No</th> 
    <th scope="col">Scat Name</th> 
    <th scope="col">Title</th>
    <th scope="col">Author</th>
    <th scope="col">Condition</th>
    <th scope="col">Date</th>
    <th scope="col">Volume</th>
   
    <th scope="col">Assection</th>
    <th scope="col">ISSN</th>
    <th scope="col">Status</th>

  </tr>

  <?php $i=1; do { ?>
    <tr>
    	<td><?php echo $i; ?></td>
    	<td><?php echo $row_cat_books['scat_name']; ?></td>
     	 <td><?php echo $row_cat_books['b_title']; ?></td>
     	 <td><?php echo $row_cat_books['b_author']; ?></td>
	      <td><?php echo $row_cat_books['b_condition']; ?></td>
	      <td><?php echo date('d-m-Y',strtotime($row_cat_books['b_date'])); ?></td>
		<td><?php echo $row_cat_books['b_volume']; ?></td>
      	
      	<td><?php echo $row_cat_books['b_assection']; ?></td>
      	<td><?php echo $row_cat_books['b_issn']; ?></td>
    
    <?php if($row_cat_books['b_status']==1){?>
     <td>Issued</td><?php } else if($row_cat_books['b_status']==0){?>
     <td>Available</td><?php }?>
    </tr>
    <?php $i++;} while ($row_cat_books = mysql_fetch_assoc($cat_books)); ?>
</table>
<?php } else if(isset($_POST['submit']) && $totalRows_cat_books==0)

{ echo "No Books"; } ?>



<?php if(isset($_POST['ssubmit']) && $totalRows_cat_bookss>0)
 {
 ?>
<table width="800" align="center" border="0" id="a">
<tr bgcolor="#FFFFFF" id="s" >
<td scope="col" colspan="9"><?php echo $row_cat_books['scat_name']; ?></th></td>
  <tr bgcolor="#FFFFFF" style="border-bottom:#666">
	<th scope="col">S.No</th> 
    
    <th scope="col">Title</th>
    <th scope="col">Author</th>
    <th scope="col">Condition</th>
    <th scope="col">Date</th>
    <th scope="col">Volume</th>
   
    <th scope="col">Assection</th>
    <th scope="col">ISSN</th>
    <th scope="col">Status</th>

  </tr>

  <?php $i=1; do { ?>
    <tr>
    	<td><?php echo $i; ?></td>
    	
     	 <td><?php echo $row_cat_books['b_title']; ?></td>
     	 <td><?php echo $row_cat_books['b_author']; ?></td>
	      <td><?php echo $row_cat_books['b_condition']; ?></td>
	      <td><?php echo date('d-m-Y',strtotime($row_cat_books['b_date'])); ?></td>
		<td><?php echo $row_cat_books['b_volume']; ?></td>
      	
      	<td><?php echo $row_cat_books['b_assection']; ?></td>
      	<td><?php echo $row_cat_books['b_issn']; ?></td>
    
    <?php if($row_cat_books['b_status']==1){?>
     <td>Issued</td><?php } else if($row_cat_books['b_status']==0){?>
     <td>Available</td><?php }?>
    </tr>
    <?php $i++;} while ($row_cat_books = mysql_fetch_assoc($cat_books)); ?>
</table>
<?php } else if (isset ($_POST['ssubmit']) && $totalRows_cat_bookss==0) 

{ echo "No Books"; } ?>

<br>
<div id="abc" >

<input type="button" value="Print Report" onClick="printpage()">
<a href="reports.php"><input type="button" value="Back to Reports"></a>
</div>
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
</html>

<?php 
mysql_free_result($cat_books);
?>
