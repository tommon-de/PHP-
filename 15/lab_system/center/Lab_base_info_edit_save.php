<?php 
//保存对实训室基础数据的修改
	$iid=$_GET['iid'];
	include("../db_connect.php");
	$code=$_POST['l_id'];
	$sits=$_POST['l_seats'];
	$admin=$_POST['l_admin'];
	$ok_itme=$_POST['l_time'];
	$con_name=$_POST['l_construct'];
	$con_type=$_POST['l_type'];
	$con_num=$_POST['l_num'];
	mysql_query("SET NAMES 'UTF8'");
		$sqls_edit="update s_shixunshi set s_shi_index='".$code."',s_shi_seats=".$sits.",
		s_shi_finish_time='".$ok_itme."',s_shi_admin=".$admin.",
		s_shi_machine_name='".$con_name."',s_shi_machine_type='".$con_type."',
		s_shi_machine_num=".$con_num." where s_id=".$iid;
		$rs_edit=mysql_query($sqls_edit,$conn);
		if($rs_edit)
		{
			echo "<script language='javascript'>
			alert('一条实训室基础信息修改成功');
			location.href='lab_base_info_list.php';
			</script>";
		}
		else
		{
			echo "<script language='javascript'>
			alert('一条实训室基础信息修改失败，请检查数据');
			location.href='lab_base_info_edit.php?iid=".$iid."';
			</script>";
		}
?>