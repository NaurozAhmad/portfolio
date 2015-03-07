<?php require_once('../Connections/connection.php'); ?>

<?php
$id=$_POST['id'];

mysql_select_db($database_connection, $connection);
$query_all_data = "SELECT * FROM sub_category where cat_id=$id";
$all_data = mysql_query($query_all_data, $connection) or die(mysql_error());
//$row_all_data = mysql_fetch_assoc($all_data);
//$totalRows_all_data = mysql_num_rows($all_data);
echo "Sub Catagory : 
	<select name='scat_id' id='scat_id'>";
while($row_all_data = mysql_fetch_assoc($all_data))
{
	$val=$row_all_data['scat_id'];
	$label=$row_all_data['scat_name'];
	
	echo 	"<option value='$val'>$label</option>
	
	
	";
	
	}
	echo 	"</select><br/>";

?>
