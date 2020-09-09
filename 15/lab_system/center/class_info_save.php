<?php
//保存班级数据
	include("../db_connect.php");
	$cid=strtoupper($_POST['c_id']);
	$cname=$_POST['c_name'];
	$cnum=$_POST['c_num'];
	$cmaster=$_POST['c_master'];
	$ctype=$_POST['c_type'];
	mysql_query("SET NAMES 'UTF8'");
		//先检查该编号班级信息是否存在
		$sqls_check="select c_id from s_class where c_id='".$cid."'";
		$rs_check=mysql_query($sqls_check,$conn);
		if($rs_check&&mysql_num_rows($rs_check)>0)
		{
			echo "<script language='javascript'>
			alert('编号为".$cid."的班级已存在，请不要重复添加');
			location.href='class_info_input.php';
			</script>";
			exit;
		}
		//如果不存在，则添加新的实训室信息
		$sql_insert="insert into s_class(c_id,c_name,c_stu_num,c_master,c_type)
		values('".$cid."','".$cname."',".$cnum.",'".$cmaster."',".$ctype.")";
		$rs_insert=mysql_query($sql_insert,$conn);
		if($rs_insert)
		{
			echo "<script language='javascript'>
			alert('一条班级信息添加成功');
			location.href='class_info_list.php';
			</script>";
		}
		else
		{
			echo "<script language='javascript'>
			alert('一条班级信息添加失败，请检查数据');
			location.href='class_info_input.php';
			</script>";
		}
?>