<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_saquabb = "localhost";
$database_saquabb = "informe";
$username_saquabb = "root";
$password_saquabb = "";
$saquabb = mysql_pconnect($hostname_saquabb, $username_saquabb, $password_saquabb) or trigger_error(mysql_error(),E_USER_ERROR); 
?>