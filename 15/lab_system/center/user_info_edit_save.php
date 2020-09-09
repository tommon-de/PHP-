<?php 
//保存对用户数据的修改
session_start();
	$uid=$_GET['uid'];
	include("../db_connect.php");
	$uname=$_POST['uname'];
	$truename=$_POST['truename'];
	$right=$_POST['inden'];
	mysql_query("SET NAMES 'UTF8'");
		$sqls_edit="update s_user set u_name='".$uname."',u_true_name='".$truename."',u_right='".$right."' where u_id=".$uid;
		$rs_edit=mysql_query($sqls_edit,$conn);
		if($rs_edit)
		{
			echo "<script language='javascript'>
			alert('一条实训室信息修改成功');
			location.href='".$_SESSION['url']."';
			</script>";
		}
		else
		{
			echo "<script language='javascript'>
			alert('一条用户信息修改失败，请检查数据');
			location.href='user_info_edit.php?uid=".$uid."';
			</script>";
		}
?>