<?php require_once('../Connections/connection.php'); ?>
<?php 
	if(isset($_GET['did']))
	{
		$did=$_GET['did'];
		$dir="pics/";
		mysql_select_db($database_connection, $connection);
		$qry=mysql_query("SELECT * FROM `staff` where `staff_id`='$did'");
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
		mysql_query("DELETE FROM `staff` WHERE `staff_id`='$did'") or die(mysql_error());
		header("Location:staff.php?Msg=Record Deleted");
	}

?>