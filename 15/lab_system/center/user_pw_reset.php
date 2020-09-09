<?php
//重置用户密码
	include("../db_connect.php");
	$reset_id=$_GET['uid'];
	$newpass=md5("123456");
	$sqls_reset="update s_user set u_pass='".$newpass."' where u_id=".$reset_id;
	$rs_reset=mysql_query($sqls_reset,$conn);
	if($rs_reset)
	{
		echo "用户密码已被重置为123456";
		echo "<a href='userinfo_list.php'>返回</a>";
	}
	else
	{
		echo "用户密码重置失败，请检查操作";
		echo "<a href='userinfo_list.php'>返回</a>";
	}
?>