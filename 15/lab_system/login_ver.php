<?php 
	session_start();
	//连接数据
	include("db_connect.php");
	//获取用户填写的信息
	$uname=$_POST['uname'];
	$upass=md5($_POST['upass']);
	//查询验证
	mysql_query("SET NAMES 'UTF8'");
	$sqls="select * from s_user where u_name='".$uname."' and u_pass='".$upass."'";
	$rs_user=mysql_query($sqls,$conn);
	if($rs_user&&mysql_num_rows($rs_user)>0)//登陆成功，判断用户身份
	{
		$arr_user=mysql_fetch_array($rs_user);
		$_SESSION['uid']=$arr_user['u_id'];
		$_SESSION['uname']=$arr_user['u_name'];
		$_SESSION['truename']=$arr_user['u_true_name'];
		$_SESSION['uright']=$arr_user['u_right'];
		header("location:index.php");
	}
	else	//登陆不成功
	{
		echo "<script language='javascript'>
		alert('登陆失败，请检查用户信息，重新登陆');
		location.href='login_info.html';
		</script>";
		exit;
	}
?>