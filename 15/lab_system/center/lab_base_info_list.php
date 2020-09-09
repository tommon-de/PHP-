<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>实训室列表</title>
<link href="../css.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#tlist {
	background-color: #CCC;
	font-size: 14px;
	color: #036;
	text-decoration: none;
}
body {
	margin-left: 0px;
	margin-top: 0px;
}
</style>
</head>

<body>
<?php
	session_start();
	include("../db_connect.php");
	if(!isset($_SESSION['uname'])||$_SESSION['uright']!=1)
	{
		header("location:../login_info.html");
		exit;
	}
	mysql_query("SET NAMES 'UTF8'");	//转换编码
	if(isset($_GET['p']))
		$p=$_GET['p'];
	else
		$p=1;
	$sqls_list="select * from s_shixunshi order by s_shi_index asc";
	$rs=mysql_query($sqls_list,$conn);
	$total=mysql_num_rows($rs);
	$page_count=ceil($total/12);
	$offset=($p-1)*12;
	$sqls_list="select * from s_shixunshi order by s_shi_index asc limit ".$offset.",12";
	$rs_list=mysql_query($sqls_list,$conn);
	if($rs_list&&mysql_num_rows($rs_list)>0)
	{
?>
<table width="100%" height="34" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist">
    <tr>
    <td height="34" align="right" bgcolor="#FFFFFF"><a href="lab_base_info_input.php" class="addnew">添加实训室</a></td>
  </tr>
  </table>
<table width="100%" height="98" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist">
  <tr>
    <td width="56" align="center" bgcolor="#CCCCCC" height="30px">序号</td>
    <td width="91" align="center" bgcolor="#CCCCCC">实训室编号</td>
    <td width="146" align="center" bgcolor="#CCCCCC">管理员</td>
    <td width="73" align="center" bgcolor="#CCCCCC">工位数</td>
    <td width="157" align="center" bgcolor="#CCCCCC">主要设备</td>
    <td width="194" align="center" bgcolor="#CCCCCC">设备型号</td>
    <td width="83" align="center" bgcolor="#CCCCCC">设备数量</td>
    <td width="153" align="center" bgcolor="#CCCCCC">完成时间</td>
    <td width="65" align="center" bgcolor="#CCCCCC">修改</td>
    <td width="61" align="center" bgcolor="#CCCCCC">删除</td>
  </tr>
  <?php for($i=0;$i<mysql_num_rows($rs_list);$i++)
  {
	  $arr_list=mysql_fetch_array($rs_list);
	  ?>
  <tr class="hang">
    <td align="center" height="30"><?php echo ($i+1);?></td>
    <td align="center"><?php echo $arr_list['s_shi_index'];?></td>
    <td align="center">
	<?php	//查出管理员的真实姓名 
	$sqls_admin="select u_true_name from s_user where u_id=".$arr_list['s_shi_admin'];
	$rs_admin=mysql_query($sqls_admin,$conn);
	$arr_admin=mysql_fetch_array($rs_admin);
	echo $arr_admin['u_true_name'];
	mysql_free_result($rs_admin);
	?></td>
    <td align="center"><?php echo $arr_list['s_shi_seats'];?></td>
    <td align="center"><?php echo $arr_list['s_shi_machine_name'];?></td>
    <td align="center"><?php echo $arr_list['s_shi_machine_type'];?></td>
    <td align="center"><?php echo $arr_list['s_shi_machine_num'];?></td>
    <td align="center"><?php echo $arr_list['s_shi_finish_time'];?></td>
    <td align="center">
    <a href="lab_base_info_edit.php?iid=<?php echo $arr_list['s_id'];?>">修改</a></td>
    <td align="center"><a href="lab_base_info_dele.php?iid=<?php echo $arr_list['s_id'];?>">删除</a></td>
  </tr>
  <?php }?>
    <tr>
    <td height="34"  colspan="10" align="center" bgcolor="#FFFFFF">
    <?php	//页码
	for($i=1;$i<=$page_count;$i++)
	{
		echo "<a href='lab_base_info_list.php?p=".$i."' class='page'>".$i."</a>&nbsp;";	
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
	echo "暂无任何实训室数据信息";
?>
</body>
</html>