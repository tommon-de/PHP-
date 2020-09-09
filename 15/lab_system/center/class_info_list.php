<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>班级信息列表</title>
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
<?php
	session_start();
	include("../db_connect.php");
	if($_SESSION['uright']!=1)
		exit;
	mysql_query("SET NAMES 'UTF8'");	//转换编码
	if(isset($_GET['p']))
		$p=$_GET['p'];
	else
		$p=1;
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//记住 url	
	$sqls_list="select * from s_class order by c_id asc";
	$rs=mysql_query($sqls_list,$conn);
	$total=mysql_num_rows($rs);
	$page_count=ceil($total/12);
	$offset=($p-1)*12;
	$sqls_list="select * from s_class order by c_id asc limit ".$offset.",12";
	$rs_list=mysql_query($sqls_list,$conn);
	if($rs_list&&mysql_num_rows($rs_list)>0)
	{
?>
<table width="100%" height="34" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist2">
  <tr>
    <td height="34" align="right" bgcolor="#FFFFFF"><a href="class_info_input.php" class="addnew">添加班级</a></td>
  </tr>
</table>
<table width="100%" height="67" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist">
  <tr>
    <td width="77" align="center" bgcolor="#CCCCCC" height="30">序号</td>
    <td width="143" align="center" bgcolor="#CCCCCC">班级编号</td>
    <td width="232" align="center" bgcolor="#CCCCCC">班级名称</td>
    <td width="94" align="center" bgcolor="#CCCCCC">人数</td>
    <td width="166" align="center" bgcolor="#CCCCCC">班主任</td>
    <td width="184" align="center" bgcolor="#CCCCCC">班级类型</td>
    <td width="91" align="center" bgcolor="#CCCCCC">修改</td>
    <td width="86" align="center" bgcolor="#CCCCCC">删除</td>
  </tr>
  <?php for($i=0;$i<mysql_num_rows($rs_list);$i++)
  {
	  $arr_list=mysql_fetch_array($rs_list);
	  ?>
  <tr class="hang">
    <td align="center" height="30"><?php echo ($i+1);?></td>
    <td align="center"><?php echo $arr_list['c_id'];?></td>
    <td align="center"><?php echo $arr_list['c_name'];?></td>
    <td align="center">
	<?php  echo $arr_list['c_stu_num'];?>
	</td>
    <td align="center"><?php echo $arr_list['c_master'];?></td>
    <td align="center"><?php if($arr_list['c_type']==0)echo "校内班级"; else echo "校外班级";?></td>
    <td align="center">
    <a href="class_info_edit.php?cid=<?php echo $arr_list['c_id'];?>">修改</a></td>
    <td align="center"><a href="class_info_dele.php?cid=<?php echo $arr_list['c_id'];?>">删除</a></td>
  </tr>
  <?php }?>
    <tr>
    <td height="34"  colspan="10" align="center" bgcolor="#FFFFFF">
    <?php	//页码
	for($i=1;$i<=$page_count;$i++)
	{
		echo "<a href='class_info_list.php?p=".$i."' class='page'>".$i."</a>&nbsp;";	
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
	echo "暂无任何班级数据信息";
?>
</body>
</html>