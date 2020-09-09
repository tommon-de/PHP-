<style type="text/css">
body{
	font-size: 14px;
	color: #039;
	margin-left: 0px;
	margin-top: 0px;
	background-color: #CCC;
}
.user:link{
	font-size:14px;
	color:#333;
	background-color:#CCC;
	border:1px solid #666;
	text-decoration:none;
	padding:3px 15px;
}
.user:visited{
	font-size:14px;
	color:#333;
	background-color:#CCC;
	border:1px solid #666;
}
.user:hover{
	font-size:14px;
	color:#333;
	background-color:#FFF;
	border:1px solid #666;
}
</style>
<table width="100%" height="30" border="0" align="center">
  <tr>
    <td width="862" style="color:#FF6">您好！<span style="color:#FFF">【
	  <?php echo $_SESSION['truename'];?>】
	</span> 欢迎使用实训室管理系统。您的身份是：<span style="color:#FFF">〖
    <?php 
	switch($_SESSION['uright'])
	{
		case 1:
			echo "系统管理员";
			break;
		case 2:
			echo "机房管理员";
			break;
		case 3:
			echo "老师";
			break;
	}
	?>〗</span>

    </td>
    <td width="249" align="center"><a href="login_out.php" class="user"><img src="pics/group_delete.png" width="16" height="16" style="padding-right:8px;border:0px;"/>注销退出</a>
    <a href="edit_pass.php" target="show" class="user"><img src="pics/group_key.png" width="16" height="16" style="padding-right:8px;border:0px;"/>修改密码</a>
     </td>
  </tr>
</table>
