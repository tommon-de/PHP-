﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>发布公告</title>
<style type="text/css">
#form1 table {
	font-size: 14px;
	color: #333;
	text-decoration: none;
	border: 1px solid #999;
}
a.page:link {
	font-size: 12px;
	color: #FFF;
	background-color: #039;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
	margin-right: 3px;
	margin-left: 3px;
	text-decoration: none;
}
a.page:visited {
	font-size: 12px;
	background-color: #009;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
	color: #FFF;
	margin-right: 3px;
	margin-left: 3px;
	text-decoration: none;
}
a.page:hover {
    font-size: 12px;
    color: #FF0;
    text-decoration: none;
    background-color: #390;
    margin-right: 3px;
    margin-left: 3px;
    padding-top: 3px;
    padding-right: 5px;
    padding-bottom: 3px;
    padding-left: 5px;
}
</style>
</head>
<?php 
	//判断是否已登录
	session_start();
	if(!isset($_SESSION['uname']))
		{echo "<script language='javascript'>";
		echo "alert('您尚未登录，请先登录');";
		echo "document.location.href='u_login.php'";
        echo "</script>";
		}		
?>

<?php require_once("../conn.php");?>
<body>
<?php 
	if(isset($_POST['button']))
		{//如果提交了表单，执行以下程序
			$gg_title=$_POST['i_title'];
			$gg_content=$_POST['i_content'];
			$gg_time=date("y-m-d h:i:s",time());	//当前系统时间
			mysql_query("SET NAMES 'UTF8'");
		$sqls="insert into notice_info(title,content,n_time)values('".$gg_title."','".$gg_content."','".$gg_time."')";
		$a=mysql_query($sqls) or die("记录添加失败");
		if($a){
		echo "<script language='javascript'>";
		echo "alert('一条公告发布成功');";
		echo "</script>";}
		}
?>
<form action="w_add.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="565" height="245" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="36" colspan="3" bgcolor="#C7E2F3">发布公告</td>
    </tr>
    <tr>
      <td width="75" height="38">公告标题</td>
      <td colspan="2"><label for="i_title"></label>
      <input name="i_title" type="text" id="i_title" value="" size="45" /></td>
    </tr>
    <tr>
      <td valign="top" bgcolor="#F0F0F0">公告正文</td>
      <td colspan="2" bgcolor="#F0F0F0"><label for="i_content"></label>
      <textarea name="i_content" id="i_content" cols="60" rows="10"></textarea></td>
    </tr>
    <tr>
      <td height="36" valign="top">&nbsp;</td>
      <td width="353" align="center"><input type="submit" name="button" id="button" value="发布" /></td>
      <td width="135" align="center"><a href="admin_index.php" class="page">返回管理首页</a></td>
    </tr>
  </table>
</form>
</body>
</html>