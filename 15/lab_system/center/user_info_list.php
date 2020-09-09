<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统账号列表</title>
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
	if($_SESSION['uright']!=1)
		exit;
	mysql_query("SET NAMES 'UTF8'");	//转换编码
	if(isset($_GET['p']))
		$p=$_GET['p'];
	else
		$p=1;
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//记住 url	
	$sqls_list="select * from s_user order by u_right asc";
	$rs=mysql_query($sqls_list,$conn);
	$total=mysql_num_rows($rs);
	$page_count=ceil($total/12);
	$offset=($p-1)*12;
	$sqls_list="select * from s_user order by u_right asc limit ".$offset.",12";
	$rs_list=mysql_query($sqls_list,$conn);
	if($rs_list&&mysql_num_rows($rs_list)>0)
	{
?>
<table width="100%" height="36" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist">
  <tr >
    <td height="34"  align="right" bgcolor="#FFFFFF"><a href="user_info_input.html" class="addnew">添加新用户</a></td>
  </tr>
</table>
<table width="100%" height="97" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist">
  <tr>
    <td width="58" align="center" bgcolor="#CCCCCC" height="30px">序号</td>
    <td width="208" align="center" bgcolor="#CCCCCC">账号</td>
    <td width="185" align="center" bgcolor="#CCCCCC">实名</td>
    <td width="251" align="center" bgcolor="#CCCCCC">身份</td>
    <td width="76" align="center" bgcolor="#CCCCCC">操作</td>
    <td width="67" align="center" bgcolor="#CCCCCC">操作</td>
    <td width="61" align="center" bgcolor="#CCCCCC">密码</td>
</tr>
  <?php for($i=0;$i<mysql_num_rows($rs_list);$i++)
  {
	  $arr_list=mysql_fetch_array($rs_list);
	  ?>
  <tr class="hang">
    <td align="center" height="29"><?php echo ($i+1);?></td>
    <td align="center"><?php echo $arr_list['u_name'];?></td>
    <td align="center"><?php echo $arr_list['u_true_name'];?></td>
    <td align="center">
    <?php 
		switch($arr_list['u_right'])
		{
			case 1:
				echo "中心管理员";
				break;
			case 2:
				echo "实训室管理员";
				break;
			case 3:
				echo "教师";
				break;			
		}
	?>
    </td>
    <td align="center"><a href="user_info_edit.php?uid=<?Php echo $arr_list['u_id'];?>">修改</a></td>
    <td align="center">
    <a href="javascript:if(confirm('你确定要删除该用户？'))window.location.href='user_info_dele.php?uid=<?php echo $arr_list['u_id'];?>'" >删除</a>
    </td>
    <td align="center"><a href="user_pw_reset.php?uid=<?Php echo $arr_list['u_id'];?>">重置</a></td>
  </tr>
  <?php }?>
  <tr >
    <td height="34" colspan="7" align="center" bgcolor="#FFFFFF">
    <?php	//页码
	for($i=1;$i<=$page_count;$i++)
	{
		echo "<a href='user_info_list.php?p=".$i."' class='page'>".$i."</a>";
		echo "&nbsp;";	
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
	echo "暂无任何系统账号";
?>
</body>
</html>