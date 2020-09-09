<?php
	//定义数据库服务器、用户名与密码
	$db_server="localhost"; 
	$db_user="root"; 
	$db_pass="root"; 
	$conn=mysql_connect($db_server,$db_user,$db_pass) or die("数据库服务器连接失败");
	//选择数据库
	$db_name="notice";
	$db_select=mysql_select_db($db_name,$conn);
	if(!$db_select)
		{echo "指定的数据库打开失败！";
		 exit;
		}
?>
	