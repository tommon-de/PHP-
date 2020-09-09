<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改公告</title>
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
<?php require_once("../conn.php");?>
<body>
<?php 
	//获取修改记录的ID号
	if(isset($_GET['id']))
		 $rid=$_GET['id']; 
	else
		{
			echo "<script language='javascript'>";
			echo "alert('请指定所要修改的记录!');";
			echo "window.location.href='admin_index.php'";
			echo "</script>";
			exit;
		}
	if(isset($_POST['button']))
		{//如果提交了表单，执行以下程序
			$gg_title=$_POST['i_title'];
			$gg_content=$_POST['i_content'];
			$gg_time=date("y-m-d h:i:s",time());	//当前系统时间
			mysql_query("SET NAMES 'UTF8'");
		$sqls="update notice_info set title='".$gg_title."',content='".$gg_content."',n_time='".$gg_time."' where id=".$rid;
		$a=mysql_query($sqls) or die("记录修改失败");
		if($a){
		echo "<script language='javascript'>";
		echo "alert('一条公告修改成功');";
		echo "window.location.href='admin_index.php'";
		echo "</script>";
		exit;
		}
		}
	$sqls="select * from notice_info where id=".$rid;
	$res=mysql_query($sqls);	//查出该ID的公告数据
	$arr=mysql_fetch_array($res);	//转换为数组
?>
<form action="w_edit.php?id=<?php echo $rid;?>" method="post" name="form1" id="form1">
  <table width="565" height="240" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="37" colspan="3" bgcolor="#C7E2F3">发布公告</td>
    </tr>
    <tr>
      <td width="75" height="38">公告标题</td>
      <td colspan="2"><label for="i_title"></label>
      <input name="i_title" type="text" id="i_title" value="<?php echo $arr['title'];?>" size="45" /></td>
    </tr>
    <tr>
      <td valign="top" bgcolor="#F0F0F0">公告正文</td>
      <td colspan="2" bgcolor="#F0F0F0"><label for="i_content"></label>
      <textarea name="i_content" id="i_content" cols="60" rows="10"><?php echo $arr['content'];?></textarea></td>
    </tr>
    <tr>
      <td height="30" valign="top">&nbsp;</td>
      <td width="353" align="center"><input type="submit" name="button" id="button" value="发布" /></td>
      <td width="135" align="center"><a href="admin_index.php" class="page">返回管理首页</a></td>
    </tr>
  </table>
</form>
</body>
</html>