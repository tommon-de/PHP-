<?php
	$db_server="localhost";
	$db_user="root";
	$db_pass="root";
	$db_name="lab";	 
	$conn=@mysql_connect($db_server,$db_user,$db_pass);
	if($conn)
		mysql_select_db($db_name);
	else
	{
		echo "数据库服务器无法连接";
		exit;
	}
?>