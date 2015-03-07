<?php require_once('../Connections/connection.php'); ?>
<?php 
	if(isset($_GET['did']))
	{
		$id=$_GET['id'];
		$did=$_GET['did'];
		$dir="pics/";
		mysql_select_db($database_connection, $connection);
		$qry=mysql_query("SELECT * FROM `students` where `st_id`='$did'");
		$prow=mysql_fetch_array($qry);
		$pic=$prow['p_name'];
		if($pic!="")
		{
			if(file_exists($dir.$pic))
			{
				unlink($dir.$pic);
			}
		}	
		mysql_select_db($database_connection, $connection);
		mysql_query("DELETE FROM `students` WHERE `st_id`='$did'") or die(mysql_error());
		header("Location:students.php?deleted");
	}

?>