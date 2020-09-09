<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>惠州城市职业学院——实训室管理系统</title>
<style type="text/css">
li{
	list-style-type:none;
	width:100%;
}
a.lm:link{
	text-decoration:none;
	font-size:14px;
	color:#333;
	padding:5px 50px;
	list-style-type:none;
	line-height:28px;
	width:100%;
}
a.lm:visited{
	text-decoration:none;
	font-size:14px;
	color:#333;
	padding:5px 50px;
	list-style-type:none;
	line-height:28px;
		width:100%;
}
a.lm:hover{
	text-decoration:none;
	font-size:14px;
	color:#333;
	padding:5px 50px;
	background-color:#CCC;
	border-bottom:1px solid #FFF;
	border-top:1px solid #FFF;
	line-height:28px;
	width:100%;
}
#yjlm{
	width:100%;
	background-color:#FFF;
	height:28px;
	line-height:28px;
}
#copyright
{	width:100%;
background-color:#0D4ECE;
color:#FFF;
font-size:14px;
text-align:center;
line-height:28px;
}
#banner
{	width:100%;
background-color:#0D4ECE;
}

</style>
</head>

<body>
<?php
	session_start();
	if(!isset($_SESSION['uname'])||$_SESSION['uname']=="")
	{
		header("location:login_info.html");
		exit;
	}
?>
<div id="banner">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#003399"><img src="pics/logo.jpg" width="613" height="59" /></td>
  </tr>
</table></div>
<table width="100%" height="580" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="15%" height="30" bgcolor="#3577FF"> </td>
    <td width="85%" align="right" bgcolor="#3577FF"><?php include("user_info.php");?></td>
  </tr>
  <tr>
    <td height="498" align="center" valign="top" bgcolor="#AAB3EA" style="border-right:1px solid #999">
    <?php 
		if($_SESSION['uright']==1 ){	//实训中心，系统管理员
	?>
    <p id="yjlm"><img src="pics/folder_edit.png" width="16" height="16" style="padding-right:5px"/>系统账号管理</p>
        <li><a href="center/user_info_input.html" target="show"  class="lm">分配用户账号</a></li>
        <li><a href="center/user_info_list.php" target="show" class="lm">管理用户账号</a></li>
    <p id="yjlm"><img src="pics/folder_edit.png" width="16" height="16" style="padding-right:5px"/>实训室数据管理</p>
        <li><a href="center/lab_base_info_input.php" target="show"  class="lm">添加实训室</a></li>
        <li><a href="center/lab_base_info_list.php" target="show" class="lm">实训室列表</a></li>
        <li><a href="center/lab_data_list.php" target="show" class="lm">数据统计汇总</a></li>
    <p id="yjlm"><img src="pics/folder_edit.png" width="16" height="16" style="padding-right:5px"/>班级数据管理</p>
        <li><a href="center/class_info_input.php" target="show" class="lm">添加班级信息</a></li>
        <li><a href="center/class_info_list.php" target="show" class="lm">班级数据列表</a></li>
    <?php }
	if($_SESSION['uright']==2){ //机房管理员?>
    <p id="yjlm"><img src="pics/folder_edit.png" width="16" height="16" style="padding-right:5px"/>实训室课程管理</p>
        <li><a href="labadmin/course_data_input.php" target="show"  class="lm">添加课程安排</a></li>
        <li><a href="labadmin/course_data_list.php" target="show" class="lm">课程安排列表</a></li>
    <p id="yjlm"><img src="pics/folder_edit.png" width="16" height="16" style="padding-right:5px"/>实训室设备管理</p>
        <li><a href="labadmin/machine_info_input.php" target="show"  class="lm">添加设备数据</a></li>
        <li><a href="labadmin/machine_info_list.php" target="show" class="lm">设备数据列表</a></li>
    <p id="yjlm"><img src="pics/folder_edit.png" width="16" height="16" style="padding-right:5px"/>实训室数据管理</p>
        <li><a href="labadmin/machine_data_list.php" target="show"  class="lm">使用数据列表</a></li>
        <li><a href="data_print.php" target="show"  class="lm">打印使用数据</a></li>
    <?php }
	if($_SESSION['uright']==3){//教师?>
    <p id="yjlm"><img src="pics/folder_edit.png" width="16" height="16" style="padding-right:5px"/>实训室使用登记</p>
        <li><a href="teacher/use_date_select.php" target="show"  class="lm">机房使用登记</a></li>
        <li><a href="teacher/use_data_list.php" target="show" class="lm">我的使用登记</a></li>
	<?php }?>
    </td>
    <td valign="top" bgcolor="#DCDEFC">
    <iframe name="show" width="100%" height="540" scrolling="auto" frameborder="0"></iframe>    
    </td>
  </tr>
</table>
<div id="copyright">版权信息&copy;2017 惠州城市职业学院信息学院 　||
设计制作：sunkinglsx<br />
交流反馈：sunkinglsx@163.com　||　课堂范例，仅供参考</div>
</body>
</html>