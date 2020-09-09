<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>删除公告</title>
</head>
<?php require("../conn.php");?>
<body>
<?php
	//获取要删除的记录ID号
	if(isset($_GET['id']))
		{$rid=$_GET['id'];}
	else
		{
			echo "<script language='javascript'>";
			echo "alert('请指定所要删除的公告破!');";
			echo "window.location.href='admin_index.php';";
			echo "</script>";
			exit;
		}
	echo "<script language='javascript'>";
	echo "if(!confirm('你确定要删除该条公告破吗？'))";
	echo "{window.location.href='admin_index.php';}";
	echo "</script>";
	$sqls="delete from notice_info where id=".$rid;
	$res=mysql_query($sqls) or die("删除记录失败");
	if($res)
		{
		echo "<script language='javascript'>";
		echo "alert('一条公告删除成功');";
		echo "window.location.href='admin_index.php'";
		echo "</script>";
		exit;
		}
?>		
</body>
</html>