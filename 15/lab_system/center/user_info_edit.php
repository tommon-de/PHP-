<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">
#form1 #tinfo {
	font-size: 14px;
	color: #036;
	text-decoration: none;
	border: 1px solid #CCC;
}
</style>
</head>

<body>
 <?php
	//查出要修改的账号信息
	include("../db_connect.php");
	$uid=$_GET['uid'];
	mysql_query("SET NAMES 'UTF8'");
	$sqls_select="select * from s_user where u_id=".$uid;
	$rs_user=mysql_query($sqls_select,$conn);
	$arr_user=mysql_fetch_array($rs_user);
?> 

<form id="form1" name="form1" method="post" action="user_info_edit_save.php?uid=<?php echo $uid;?>">
<table width="100%" height="201" border="0" align="center" cellpadding="0" cellspacing="0" id="tinfo">
    <tr>
      <td height="36" colspan="2" bgcolor="#CCCCCC"> 中心管理》系统用户信息修改</td>
    </tr>
    <tr>
      <td width="200" height="39" align="center" bgcolor="#FFFFFF">用户名</td>
      <td width="817" bgcolor="#FFFFFF"><label for="uname"></label>
      <input type="text" name="uname" id="uname"  value="<?php echo $arr_user['u_name'];?>"/></td>
    </tr>
    <tr>
      <td height="35" align="center" bgcolor="#FFFFFF">真实姓名</td>
      <td bgcolor="#FFFFFF"><label for="truename"></label>
      <input type="text" name="truename" id="truename"  value="<?php echo $arr_user['u_true_name'];?>"/></td>
    </tr>
    <tr>
      <td height="35" align="center" bgcolor="#FFFFFF">权限身份</td>
      <td bgcolor="#FFFFFF">
        <label>
          <input type="radio" name="inden" value="1" id="inden_0" <?php if($arr_user['u_right']==1){?> checked="checked"<?php }?>/>
          中心管理员</label>
        <label>
          <input type="radio" name="inden" value="2" id="inden_1" <?php if($arr_user['u_right']==2){?> checked="checked"<?php }?>/>
          实训室管理员</label>
        <label>
          <input type="radio" name="inden" value="3" id="inden_2" <?php if($arr_user['u_right']==3){?> checked="checked"<?php }?>/>
          教师</label>
      </td>
    </tr>
    <tr>
      <td height="42" colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" name="button" id="button" value="保存修改" /></td>
    </tr>
  </table>
</form>
</body>
</html>