<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>公告正文</title>
<style type="text/css">
body,td,th {
	font-size: 12px;
	line-height: 22px;
}
#t_content {
	background-color: #CCC;
}
</style>
</head>
<?php require_once("conn.php");
	   $nid=$_GET['n_id'];
	   mysql_query("SET NAMES 'UTF8'");
	   $sqls="select * from notice_info where id=$nid";
	   $res=mysql_fetch_array(mysql_query($sqls));
?>
<body>
<table width="800" height="43" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="43" align="center" bgcolor="#C7E2F3">校园公告正文</td>
  </tr>
</table>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="15" height="27" bgcolor="#F0F0F0">&nbsp;</td>
    <td width="361" bgcolor="#F0F0F0">〖标题〗<?php echo $res['title'];?></td>
    <td width="274" bgcolor="#F0F0F0">〖发布时间〗<?php echo $res['n_time'];?></td>
  </tr>
</table>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="1" id="t_content">
  <tr>
    <td height="216" valign="top" bgcolor="#FFFFFF">〖正文〗<br />
<?php echo $res['content'];?></td>
  </tr>
</table>
<?php mysql_close();?>
</body>
</html>