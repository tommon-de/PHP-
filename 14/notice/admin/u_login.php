<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理登录</title>
<style type="text/css">
body {
	background-color: #F2F2F2;
}
</style>
</head>
<?php require("../conn.php");?>
<body>
<?php
	if(!empty($_POST['button']))
		{
			$uname=$_POST['u_name'];
			$upass=$_POST['u_pass'];
			$sqls="select * from user_admin where u_name='".$uname."' and u_pass='".$upass."'";
			$res=mysql_query($sqls);
			$res_count=mysql_num_rows($res);
			if($res_count!=0)
				{	
					session_start();
					$arr=mysql_fetch_array($res);
					$_SESSION['uname']=$arr['u_name'];
					echo "<script language='javascript'>alert('登录成功！');";
					echo "window.location.href='admin_index.php'";
					echo "</script>";
					exit;
				}
			else
				{
					echo "<script language='javascript'>alert('登录失败，请重新登录！');";
					echo "</script>";
				}
		}


?>
<form id="form1" name="form1" method="post" action="u_login.php">
  <table width="411" height="140" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" align="center" bgcolor="#E4F1F8">管理登录</td>
    </tr>
    <tr>
      <td width="142" align="center" bgcolor="#FFFFFF">用户名：</td>
      <td width="269" bgcolor="#FFFFFF"><label for="u_name"></label>
      <input type="text" name="u_name" id="u_name" /></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFFFF">密　码：</td>
      <td bgcolor="#FFFFFF"><label for="u_pass"></label>
      <input type="password" name="u_pass" id="u_pass" /></td>
    </tr>
    <tr>
      <td height="35" align="center" bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF"><input type="submit" name="button" id="button" value="登录" /></td>
    </tr>
  </table>
</form>
</body>
</html>