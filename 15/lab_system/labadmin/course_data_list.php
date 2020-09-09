<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>实训室课程列表</title>
<link href="../css.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#tlist {
	background-color: #CCC;
	font-size: 14px;
	color: #036;
	text-decoration: none;
}
.hang
{
	background-color:#FFF;
}
.hang:hover{
	background-color:#D6EEBD;}
body {
	margin-left: 0px;
	margin-top: 0px;
}
</style>
</head>

<body>
<table width="100%" height="30" border="0" align="center" cellpadding="0" cellspacing="0" id="tlist">
    <tr>
      <td width="62%" height="30"  bgcolor="#FCFCC5">实训室设备情况数据</td>
      <td width="38%" height="30"  bgcolor="#FCFCC5">
	<?php 
	session_start();
	include("../db_connect.php");
	//查出所负责的实训室
	mysql_query("SET NAMES 'UTF8'");	//转换编码
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//记住 url	
	$sqls_lab_admin="select distinct(s_shi_index) from s_shixunshi where s_shi_admin=".$_SESSION['uid'];
	$rs_lab_admin=mysql_query($sqls_lab_admin,$conn);
	for($i=0;$i<mysql_num_rows($rs_lab_admin);$i++)
	{
		$arr_lab_admin=mysql_fetch_array($rs_lab_admin);
		$labs[$i]=$arr_lab_admin['s_shi_index'];//实训室编号数组
	}
	if(count($labs)==0)
		echo "请联系实训中心给您分配实训室";
	else
	{
	?>
      <form action="course_data_list.php" method="post" name="form1" id="form1">
        <?php 
	 echo "请选择要浏览的实训室：";
	 foreach($labs as $v){?>
        <label>
          <input type="radio" name="lab" value="<?php echo $v;?>" id="lab_0" />
          <?php echo $v;?></label>
        <?php }?>
        <input type="submit" name="button" id="button" value="确定" />
      </form>
      <?php }?>
      </td>
    </tr>
  </table>
  <?php
	if(isset($_GET['p']))
		$p=$_GET['p'];
	else
		$p=1;
	if(isset($_POST['lab']))//获取所要浏览的实训室号
	{
		$d=$_POST['lab'];
		$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.'lab='.$d;
		$_SESSION['url']=$url;
	}
	if(isset($_GET['lab']))
		$d=$_GET['lab'];
	if(!isset($d)||$d=="")
		exit;
	$weeks=array("星期天","星期一","星期二","星期三","星期四","星期五","星期六");
	$sqls_list="select * from s_class_plan where p_shi_id='".$d."' order by p_xingqi asc";
	$rs=mysql_query($sqls_list,$conn);
	$total=mysql_num_rows($rs);
	$page_count=ceil($total/12);
	$offset=($p-1)*12;
	$sqls_list="select * from s_class_plan where p_shi_id='".$d."' order by p_xingqi asc limit ".$offset.",12";
	$rs_list=mysql_query($sqls_list,$conn);
	if($rs_list&&mysql_num_rows($rs_list)>0)
	{
?>
<table width="100%" height="34" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist2">
  <tr>
    <td height="34" align="right" bgcolor="#FFFFFF"><a href="course_data_input.php" class="addnew">添加课程安排</a></td>
  </tr>
</table>
<table width="100%" height="67" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist">
  <tr>
    <td width="79" align="center" bgcolor="#CCCCCC" height="30">序号</td>
    <td width="148" align="center" bgcolor="#CCCCCC">实训室编号</td>
    <td width="169" align="center" bgcolor="#CCCCCC">星期</td>
    <td width="149" align="center" bgcolor="#CCCCCC">班级</td>
    <td width="143" align="center" bgcolor="#CCCCCC">节次</td>
    <td width="202" align="center" bgcolor="#CCCCCC">课程</td>
    <td width="131" align="center" bgcolor="#CCCCCC">任课老师</td>
    <td width="93" align="center" bgcolor="#CCCCCC">删除</td>
  </tr>
  <?php for($i=0;$i<mysql_num_rows($rs_list);$i++)
  {
	  $arr_list=mysql_fetch_array($rs_list);
	  ?>
  <tr class="hang">
    <td align="center" height="30"><?php echo ($i+1);?></td>
    <td align="center"><?php echo $arr_list['p_shi_id'];?></td>
    <td align="center"><?php echo $weeks[$arr_list['p_xingqi']];?></td>
    <td align="center">
	<?php  echo $arr_list['p_class_id'];?>
	</td>
    <td align="center"><?php echo "第".$arr_list['p_node']."节";?></td>
    <td align="center"><?php echo $arr_list['p_lesson'];?></td>
    <td align="center">
	<?php 
		$sqls_t_name="select u_true_name from s_user where u_id=".$arr_list['p_teacher_id'];
		$rs_t_name=mysql_query($sqls_t_name,$conn);
		$arr_t_name=mysql_fetch_array($rs_t_name);
		echo $arr_t_name['u_true_name'];
		mysql_free_result($rs_t_name);
	?>
    </td>
    <td align="center"><a href="course_data_dele.php?cid=<?php echo $arr_list['p_id'];?>">删除</a></td>
  </tr>
  <?php }?>
    <tr>
    <td height="34"  colspan="10" align="center" bgcolor="#FFFFFF">
    <?php	//页码
	for($i=1;$i<=$page_count;$i++)
	{
		echo "<a href='course_data_list.php?p=".$i."&lab=".$d."' class='page'>".$i."</a>&nbsp;";	
	}	
	?>    
    </td>
  </tr>
</table>
<?php 
	mysql_free_result($rs_list);	//释放记录集
	mysql_close($conn);
}
else
	echo "暂无任何课程安排数据";
?>
</body>
</html>