<?php
//保存新添实训室基础数据
	include("../db_connect.php");
	$code=$_POST['l_id'];
	$sits=$_POST['l_seats'];
	$admin=$_POST['l_admin'];
	$ok_itme=$_POST['l_time'];
	$con_name=$_POST['l_construct'];
	$con_type=$_POST['l_type'];
	$con_num=$_POST['l_num'];
	mysql_query("SET NAMES 'UTF8'");
		//先检查该编号的实训室信息是否存在
		$sqls_check="select s_shi_index from s_shixunshi where s_shi_index='".$code."'";
		$rs_check=mysql_query($sqls_check,$conn);
		if($rs_check&&mysql_num_rows($rs_check)>0)
		{
			echo "<script language='javascript'>
			alert('编号为".$code."的实训室基础信已存在，请不要重复添加');
			location.href='lab_base_info_input.php';
			</script>";
			exit;
		}
		//如果不存在，则添加新的实训室信息
		$sql_insert="insert into s_shixunshi(s_shi_index,
		s_shi_seats,s_shi_finish_time,s_shi_admin,
		s_shi_machine_name,s_shi_machine_type,s_shi_machine_num)
		values('".$code."',".$sits.",'".$ok_itme."',".$admin.",
		'".$con_name."','".$con_type."',".$con_num.")";
		$rs_insert=mysql_query($sql_insert,$conn);
		if($rs_insert)
		{
			echo "<script language='javascript'>
			alert('一条实训室基础信息添加成功');
			location.href='lab_base_info_list.php';
			</script>";
		}
		else
		{
			echo "<script language='javascript'>
			alert('一条实训室基础信息添加失败，请检查数据');
			location.href='lab_base_info_input.php';
			</script>";
		}
?>