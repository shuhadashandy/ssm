<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_dssm = "localhost";
$database_dssm = "syamsury_profile";
$username_dssm = "syamsury_profile";
$password_dssm = "Syamsurya==3x1m";
$dssm = mysql_pconnect($hostname_dssm, $username_dssm, $password_dssm) or trigger_error(mysql_error(),E_USER_ERROR); 
?>