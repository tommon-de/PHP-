<?php
session_start();
//保存机房课程安排
include('..\db_connect.php');
$plan=$_POST['r'];	//课程安排
$plan_num=count($plan);//课程安排数量
if($plan_num==0)
{
	echo "<script language='javascript'>
	alert('请添加课程安排数据');
	location.href='course_date_input.php';
	</script>";
	exit;
}
$all_add_ok=0;
foreach($plan as $v)	//遍历所有的复选框数组
{
	$arr_plan=explode("#",$v);
	$sqls_add_plan="insert into s_class_plan(p_shi_id,p_xingqi,p_class_id,p_lesson,	p_teacher_id,p_node)values(
	'".$arr_plan[0]."',".$arr_plan[1].",'".$arr_plan[2]."',
	'".$arr_plan[4]."',".$arr_plan[5].",'".$arr_plan[3]."')";
	$rs_add_plan=mysql_query($sqls_add_plan,$conn);
	if($rs_add_plan)
		$all_add_ok+=1;
}
if($all_add_ok==$plan_num)
{
	echo "<script language='javascript'>
	alert('".$plan_num."条课程安排保存成功');
	location.href='course_data_list.php';
	</script>";
}
else
{
	echo "<script language='javascript'>
	alert('".($plan_num-$all_add_ok)."条课程安排未能保存，请检查数据，重新添加并保存');
	location.href='course_data_list.php';
	</script>";
}
?>