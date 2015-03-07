<?php require_once('../Connections/connection.php'); ?>
<?php if(isset($_GET['bid']) && $_GET['id'])
{
	
	$bid=$_GET['bid'];
	$id=$_GET['id'];
	$issue=$_GET['is'];
	$staff=7;
	$datee=date('y-m-d');
	mysql_select_db($database_connection, $connection);
	mysql_query("UPDATE issue SET end_date='$datee' where issue_id=$issue" ) or die(mysql_error());	
	mysql_query("UPDATE books SET b_status=0 where b_id=$bid") or die(mysql_error());
	header("Location:student_detail.php?id=$id");
	}
	
	
	?>
