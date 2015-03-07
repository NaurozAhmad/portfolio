<?php
$db_server = "localhost";
$db_name = "portfolio";
$db_user = "root";
$db_pass = "";
$con = @mysql_pconnect($db_server, $db_user, $db_pass) or trigger_error(mysql_error(),E_USER_ERROR);
?>
