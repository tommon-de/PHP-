<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>大学生基本情况问卷调查</title>
<style type="text/css">
 #t {
	border: 1px solid #CCC;
	font-size: 14px;
	color: #333;
	text-decoration: none;
}
.txt {
	font-family: "黑体";
	font-size: 24px;
	color: #000;
	text-decoration: none;
}
 #t tr td {
	height: 25px;
}
</style>
</head>

<body>
<?php 
	$err="";//错误提示
	if(!isset($_POST['sex']))
		$err.="请选择您的性别<br>";
	else
		$sex=$_POST['sex'];
	if(!isset($_POST['age']))
		$err.="请选择您的年龄<br>";
	else
		$age=$_POST['age'];
	if(!isset($_POST['edu']))
		$err.="请选择您的学历层次<br>";
	else
		$edu=$_POST['edu'];
	if(!isset($_POST['major'])||strip_tags($_POST['major'])=="")
		$err.="请正确填写您的专业名称<br>";
	else
		$major=strip_tags($_POST['major']);//过滤处理
	if(!isset($_POST['cadre']))
		$err.="请选择学生干部任职情况<br>";
	else
		$is_cadre=$_POST['cadre'];
	if(!isset($_POST['inte']))
		$err.="请选择您的兴趣爱好<br>";
	else
		$interest=$_POST['inte'];
	if(!isset($_POST['read']))
		$err.="请选择您的阅读频率<br>";
	else
		$read=$_POST['read'];
	if(!isset($_POST['part']))
		$err.="请选择您的兼职情况<br>";
	else	
		$p_time=$_POST['part'];
	if($err!="")
	{
		echo $err;
		echo "<a href='index.html'>返回操作</a>";
		exit;
	}
?>
  <table width="720" border="0" align="center" cellpadding="10" cellspacing="0" id="t">
    <tr>
      <td height="63" colspan="2" align="center" bgcolor="#CCCCCC" class="txt">大学生基本情况问卷调查</td>
    </tr>
    <tr>
      <td width="106" height="41">性别</td>
      <td width="574"><?php echo $sex;?></td>
    </tr>
    <tr>
      <td bgcolor="#DFE9F2">年龄</td>
      <td bgcolor="#DFE9F2"><?php echo $age;?></td>
    </tr>
    <tr>
      <td>学历</td>
      <td><?php echo $edu;?></td>
    </tr>
    <tr>
      <td bgcolor="#DFE9F2">专业</td>
      <td bgcolor="#DFE9F2"><?php echo $major;?></td>
    </tr>
    <tr>
      <td>是否学生干部</td>
      <td><?php echo $is_cadre;?></td>
    </tr>
    <tr>
      <td bgcolor="#DFE9F2">兴趣爱好</td>
      <td bgcolor="#DFE9F2">
      <?php
	  foreach($interest as $k)
	  	echo $k."&nbsp;";
	  ?>
      </td>
    </tr>
    <tr>
      <td>阅读频率</td>
      <td><?php echo $read;?></td>
    </tr>
    <tr>
      <td bgcolor="#DFE9F2">是否兼职</td>
      <td bgcolor="#DFE9F2"><?php echo $p_time;?></td>
    </tr>
    </tr>
  </table>
</body>
</html>