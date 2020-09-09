<?php
session_start();
//保存机房课程安排
	include('..\db_connect.php');
	$plan=$_POST['r'];	//机器资料
	$plan_num=count($plan);//机器资料数量
	if($plan_num==0)
	{
		echo "<script language='javascript'>
		alert('请添加机器设备与配件数据');
		location.href='machine_info_input.php';
		</script>";
		exit;
	}
	$all_add_ok=0;
	foreach($plan as $v)
	{
		$arr_plan=explode("#",$v);
		//机器名  $arr_err[0];		
		//设备名  $arr_err[1];		
		//故障描述  $arr_err[2];	
		$sqls_add_plan="insert into s_machine(m_shi_id,m_name,m_bujian)values('".$arr_plan[0]."','".$arr_plan[1]."',
		'".$arr_plan[2]."')";
		$rs_add_plan=mysql_query($sqls_add_plan,$conn);
		if($rs_add_plan)
			$all_add_ok+=1;
	}
	if($all_add_ok==$plan_num)
	{
		echo "<script language='javascript'>
		alert('".$plan_num."条机器资料保存成功');
		location.href='machine_info_list.php';
		</script>";
	}
	else
	{
		echo "<script language='javascript'>
		alert('".($plan_num-$all_add_ok)."条机器资料未能保存，请检查数据，重新添加并保存');
		location.href='machine_info_input.php';
		</script>";
	}
?>