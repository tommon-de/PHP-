<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改账户密码</title>
<link href="css.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" height="192" border="0" align="center" cellpadding="5" cellspacing="1" id="tlist">
    <tr>
      <td colspan="2">修改账户密码</td>
    </tr>
    <tr>
      <td width="19%" height="38" align="center" bgcolor="#FFFFFF">原密码</td>
      <td width="81%" bgcolor="#FFFFFF"><label for="o_pass"></label>
      <input name="o_pass" type="password" class="list" id="o_pass" /></td>
    </tr>
    <tr>
      <td height="35" align="center" bgcolor="#FFFFFF">新密码</td>
      <td bgcolor="#FFFFFF"><label for="n_pass"></label>
      <input name="n_pass" type="password" class="list" id="n_pass" /></td>
    </tr>
    <tr>
      <td height="37" align="center" bgcolor="#FFFFFF">确认新密码</td>
      <td bgcolor="#FFFFFF"><label for="v_pass"></label>
      <input name="v_pass" type="password" class="list" id="v_pass" /></td>
    </tr>
    <tr>
      <td height="39" colspan="2" align="center"><input name="button" type="submit" class="button_style" id="button" value="确认修改" /></td>
    </tr>
  </table>
</form>
<?php
//修改账号密码
session_start();
if(isset($_POST['button']))
{
	include("db_connect.php");
	$opass=$_POST['o_pass'];
	$npass=$_POST['n_pass'];
	$vpass=$_POST['v_pass'];
	//检查新密码确认是否一致
	if($npass!=$vpass)
	{
		echo "<script language='javascript'>
		alert('密码确认不正确，请重新输入');
		location.href='edit_pass.php';
		</script>";
		exit;
	}
	//检查旧密码是否正确
	mysql_query("SET NAMES 'UTF8'");
	$sqls="select * from s_user where u_name='".$_SESSION['uname']."' and u_pass='".md5($opass)."'";
	$rs=mysql_query($sqls,$conn);
	if($rs&&mysql_num_rows($rs)>0)//用户旧密码正确
	{
		$arr=mysql_fetch_array($rs);
		$sqls="update s_user set u_pass='".md5($npass)."' where u_id=".$arr['u_id'];
		$rs=mysql_query($sqls,$conn);
		if($rs)
		{
			echo "<script language='javascript'>
			alert('密码修改成功，请重新登录');
			window.parent.frames.location.href='login_info.html';
			</script>";
			session_destroy();//销毁登录信息
			exit;
		}
		else
		{
			echo "<script language='javascript'>
			alert('密码修改失败，请重新设置新密码');
			location.href='edit_pass.php';
			</script>";
			exit;
		}
	}
	else
	{
		echo "<script language='javascript'>
		alert('旧密码不正确，请重新输入');
		location.href='edit_pass.php';
		</script>";
		exit;
	}
}

?>
</body>
</html>