<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理首页</title>
<style type="text/css">
body,td,th {
	font-size: 12px;
}
body {
	background-color: #EBEBEB;
}
a:link {
	font-size: 12px;
	color: #069;
	text-decoration: none;
}
a:visited {
	font-size: 12px;
	color: #069;
	text-decoration: none;
}
a:hover {
	font-size: 12px;
	color: #900;
	text-decoration: none;
}
a.list:link {
	font-size: 14px;
	color: #039;
	text-decoration: none;
	background-color: #FFFF99;
	padding-right: 10px;
	padding-left: 10px;
	padding-top: 5px;
	padding-bottom: 5px;
	margin-right: 5px;
	margin-left: 5px;
}
a.list:visited {
	font-size: 14px;
	color: #039;
	text-decoration: none;
	background-color: #FFFF99;
	padding-right: 10px;
	padding-left: 10px;
	padding-top: 5px;
	padding-bottom: 5px;
	margin-right: 5px;
	margin-left: 5px;
}
a.list:hover {
	font-size: 14px;
	color: #039;
	text-decoration: none;
	background-color: #00FF99;
	padding-right: 10px;
	padding-left: 10px;
	padding-top: 5px;
	padding-bottom: 5px;
	margin-right: 5px;
	margin-left: 5px;
}

</style>
</head>
<?php require("../conn.php");?>
<body>
<?php 
	//判断是否登录
	session_start();
	if(!isset($_SESSION['uname']))
		{echo "<script language='javascript'>alert('你还未登录，请先登录！');";
		 echo "window.location.href='u_login.php';";
		 echo "</script>";
		}
	//判断当前分页
	if(isset($_GET['p_id']))
		{$c_page=$_GET['p_id'];}
	else
		{$c_page=1;}
	$sqls="select * from notice_info";
	$res_count=mysql_num_rows(mysql_query($sqls));//记录总数
	$offset=($c_page-1)*10;	//每页10条，计算本页起始位置
	$page_count=ceil($res_count/10);//计算总页数
	$sqls="select * from notice_info limit ".$offset.",10";
	$res=mysql_query($sqls);//查出本页的记录
?>
<table width="720" height="41" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="401" height="41" bgcolor="#99CCFF">校园公告栏【后台管理】</td>
    <td width="324" align="center" valign="middle" bgcolor="#99CCFF">〖<?php echo $_SESSION['uname'];?>〗欢迎您!　今天是：<?php echo date("y-m-d h:i:s",time());?></td>
  </tr>
</table>
<?php 
	if($res_count==0)
	{
?>
<table width="720" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="41" align="center" bgcolor="#DDF4F2" class="list" >暂无任何校园公告</td>
  </tr>
</table>
<?php }
	else
	{?>
<table width="720" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="64" height="31" align="center" valign="middle" bgcolor="#FFFFFF">序号</td>
    <td width="332" align="center" valign="middle" bgcolor="#FFFFFF">标题</td>
    <td width="172" align="center" valign="middle" bgcolor="#FFFFFF">发布时间</td>
    <td colspan="2" align="center" valign="middle" bgcolor="#FFFFFF">管理</td>
  </tr>
  <?php 
  		$res_arr=mysql_fetch_array($res);
		do{?>
  <tr>
    <td height="31" align="center" valign="middle" bgcolor="#FFFFFF"><?php echo $res_arr[0];?></td>
    <td valign="middle" bgcolor="#FFFFFF" ><a href="../notice.php?n_id=<?php echo $res_arr[0];?>" target="_blank" ><?php echo $res_arr[1];?></a></td>
    <td align="center" valign="middle" bgcolor="#FFFFFF"><?php echo $res_arr[3];?></td>
    <td width="78" align="center" valign="middle" bgcolor="#FFFFFF"><a href="w_edit.php?id=<?php echo $res_arr[0];?>" class="list" >修改</a></td>
    <td width="74" align="center" valign="middle" bgcolor="#FFFFFF"><a href="w_del.php?id=<?php echo $res_arr[0];?>" class="list" >删除</a></td>
  </tr>
  <?php
		}
		while($res_arr=mysql_fetch_array($res));
	?>
</table>
<?php }?>
<table width="720" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="41" align="center" bgcolor="#DDF4F2" class="list" >
    <?php
		//输出页码列表
		for($i=1;$i<=$page_count;$i++)
			{echo "<a href=admin_index.php?p_id=$i class=list>".$i."</a>";}
	?>
    </td>
  </tr>
</table>
<table width="720" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="569" height="36" align="center" bgcolor="#D2E6F0">&nbsp;</td>
    <td width="151" align="center" bgcolor="#D2E6F0"><a href="w_add.php" class="list" >发布新公告</a></td>
  </tr>
</table>
</body>
</html>