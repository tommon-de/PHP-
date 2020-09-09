<?php 
//保存对班级数据的修改
session_start();
	$cid=$_GET['cid'];
	include("../db_connect.php");
	$cid=strtoupper($_POST['c_id']);
	$cname=$_POST['c_name'];
	$cnum=$_POST['c_num'];
	$cmaster=$_POST['c_master'];
	$ctype=$_POST['c_type'];
	mysql_query("SET NAMES 'UTF8'");
		$sqls_edit="update s_class set c_id='".$cid."',c_name='".$cname."',
		c_stu_num=".$cnum.",c_master='".$cmaster."',c_type=".$ctype." where c_id='".$cid."'";
		$rs_edit=mysql_query($sqls_edit,$conn);
		if($rs_edit)
		{
			echo "<script language='javascript'>
			alert('班级信息修改成功');
			location.href='".$_SESSION['url']."';
			</script>";
		}
		else
		{
			echo "<script language='javascript'>
			alert('班级信息修改失败，请检查数据');
			location.href='class_info_edit.php?cid=".$cid."';
			</script>";
		}
?>