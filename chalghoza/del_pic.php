<?php require_once('Connections/connection.php'); ?>

<?php 
	if(isset($_GET['did']))
	{
		$did=$_GET['did'];
		$dir="pics/";
		
		$qry=mysql_query("SELECT * FROM `pics` where `p_id`='$did'");
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
		mysql_query("DELETE FROM `pics` WHERE `p_id`='$did'") or die(mysql_error());
		header("Location:pics.php?Msg=Pic Deleted");
	}

?>