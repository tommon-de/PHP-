<?php
session_start();
//保存使用情况数据
	include('..\db_connect.php');
	$lab=$_POST['lab_index'];
	$w_index=$_POST['week_index'];	//周次
	$w_num=$_POST['xingqi'];	//星期
	$lesson=$_POST['lesson'];//上课节次
	$bj=$_POST['class'];//班级
	$teacher=$_SESSION['truename'];	//上课老师
	$err=$_POST['r'];	//机器部件的故障描述
	$err_num=count($err);//故障数量
	$ltime=date("Y-m-d H:i:s",time());
	
	if($err_num==0)
	{
		echo "<script language='javascript'>
		alert('请添加使用情况');
		location.href='use_date_select.php';
		</script>";
		exit;
	}
	$all_add_ok=0;
	foreach($err as $v)
	{
		$arr_err=explode("#",$v);
		//机器名  $arr_err[0];		
		//设备名  $arr_err[1];		
		//故障描述  $arr_err[2];	
		$sqls_add_err="insert into s_using_list(l_shi_id,l_m_name,l_c_name,l_zhou,
		l_xingqi,l_node,l_class,l_teacher,l_m_pro,l_time)values('".$lab."','".$arr_err[0]."',
		'".$arr_err[1]."',".$w_index.",".$w_num.",'".$lesson."','".$bj."','".$teacher."',
		'".$arr_err[2]."','".$ltime."')";
		$rs_add_err=mysql_query($sqls_add_err,$conn);
		if($rs_add_err)
			$all_add_ok+=1;
	}
	if($all_add_ok==$err_num)
	{
		echo "<script language='javascript'>
		alert('".$err_num."条实训室使用数据保存成功');
		location.href='use_data_list.php';
		</script>";
	}
	else
	{
		echo "<script language='javascript'>
		alert('".($err_num-$all_add_ok)."条实训室使用数据未能保存，请检查数据，重新添加并保存');
		location.href='use_data_list.php';
		</script>";
	}
?>