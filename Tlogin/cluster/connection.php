<?php
	$mysql_hostname = "mysql.hostinger.in";
	$mysql_user = "u570247755_data";
	$mysql_password = "123456";
	$mysql_database = "u570247755_host";
	$conn = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die('Could not connect: ' . mysql_error());
	mysql_select_db($mysql_database, $conn) or die('Could not get data: ' . mysql_error());
?>