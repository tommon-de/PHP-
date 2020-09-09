<?php
	include("../db_connect.php");
	$uname=$_POST['uname'];
	$truename=$_POST['truename'];
	$iden=intval($_POST['inden']);
	$upass=md5("123456");
	mysql_query("SET NAMES 'UTF8'");	//把数据编码改为utf8
	$sql_insert="insert into s_user(u_name,u_pass,u_true_name,u_right)values('".$uname."'
	,'".$upass."','".$truename."',".$iden.")";
	$rs=mysql_query($sql_insert,$conn);
	if($rs)
	{
		echo "<script language='javascript'>
		alert('一条用户账号分配成功');
		location.href='user_info_list.php';
		</script>";
	}
	else
	{
		echo "<script language='javascript'>
		alert('用户账号分配失败，请检查数据是否填写正确');
		location.href='user_info_input.php';
		</script>";
	}
?>