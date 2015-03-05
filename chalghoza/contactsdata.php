
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

mysql_select_db($database_connection, $connection);
$query_data = "SELECT * FROM contact";
$data = mysql_query($query_data, $connection) or die(mysql_error());
//$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

if(isset($_GET['id']))
{
	$id=$_GET['id'];
mysql_select_db($database_connection, $connection);
$query_message = "SELECT * FROM contact where c_id=$id";
$message = mysql_query($query_message, $connection) or die(mysql_error());
//$row_message = mysql_fetch_assoc($message);
$totalRows_message = mysql_num_rows($message);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Jquery Simple Loader Modal Plugin</title>
<meta name="robots" content="noindex,nofollow">
	<link rel="stylesheet" href="css/demo.css" />
	<link rel="stylesheet" href="css/contactpopup.css" />
	<script src="js/jquery.js"></script>
    <script src="js/contactpopup.js"></script>
	<script src="js/demo.js"></script>
	
	<script type="text/javascript">
	
		$(function(){
			// Init Plugin
			$(".clickable").contactpopup({
				'formelement' : '#Form_PopContactUs',
				'transition' : '' // options - slide,fade,grow
			});
			$(".clickableFade").contactpopup({
				'formelement' : '#Form_PopContactUs',
				'transition' : 'fade' // options - slide,fade,grow
			});
			$(".clickableSlide").contactpopup({
				'formelement' : '#Form_PopContactUs',
				'transition' : 'slide' // options - slide,fade,grow
			});
			$(".clickableGrow").contactpopup({
				'formelement' : '#Form_PopContactUs',
				'transition' : 'grow' // options - slide,fade,grow
			});
		});
		
    </script>
</head>

<body>

<div id="pagewrapper">
     
                   
                <div class="content events careers">
                    <div id="column-1">
					
					<a class="clickableFade" href="#">Fade Effect</a>
					<a class="clickableSlide" href="#">Slide Effect</a>
					<a class="clickableGrow" href="#">Grow Effect</a>	
					</p>
					

<table border="1">
  <tr>
 
    <td>Name</td>
    <td>Email</td>
    <td>date</td>
  </tr>
  <?php while ($row_data = mysql_fetch_assoc($data)) { ?>
    <tr>
    
      <td><a class="clickableFade" href="#?id=<?php echo $row_data['c_id']; ?>"
><?php echo $row_data['c_author']; ?></a></td>
      
      <td><a href="message.php?id=<?php echo $row_data['c_id']; ?>"><?php echo $row_data['c_sender']; ?></a></td>
      <td> <a href="message.php?id=<?php echo $row_data['c_id']; ?>"><?php echo date('d-M-Y',strtotime($row_data['date'])); ?></a></td>
    </tr>
    <?php }  ?>
</table>
	
					</div>

					<div class="clear"></div>
<div id="Form_PopContactUs">
asasas

<table border="1">
 <?php 
 

 
 while ($row_message = mysql_fetch_assoc($message)) { ?>
 <tr> <tr>
    <td>c_id</td><td><?php echo $row_message['c_id']; ?></td></tr>
   <tr> <td>c_author</td><td><?php echo $row_message['c_author']; ?></td></tr>
  <tr>  <td>c_sender</td><td><?php echo $row_message['c_sender']; ?></td></tr>
  <tr>  <td>c_subject</td><td><?php echo $row_message['c_subject']; ?></td></tr>
  <tr>  <td >c_message</td><td><?php echo $row_message['c_message']; ?></td></tr>
 <tr>   <td>date</td><td><?php echo $row_message['date']; ?></td></tr>
  </tr>
  
    
    <?php }  ?>
</table>

</div>


                </div>
            </div>
		</div> 
    </div>
</body>
</html>
<?php
mysql_free_result($data);
?>
<?php
if(isset($_GET['id'])){mysql_free_result($message);}
?>
