<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connection = "hashdevs.herobo.com";
$database_connection = "a1918149_portfo";
$username_connection = "a1918149_ahmar";
$password_connection = "saddar22!@#";
$connection = @mysql_pconnect($hostname_connection, $username_connection, $password_connection) or trigger_error(mysql_error(),E_USER_ERROR); 
?>