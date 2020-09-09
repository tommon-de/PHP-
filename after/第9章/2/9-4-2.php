<style type="text/css">
.bk {	border: 1px solid #CCC;
}
</style>
<?php
	$xm=$_POST['xm'];
	$mm=$_POST['mm'];
	$xb=$_POST['xb'];
	$tel=$_POST['tel'];
	$fsize=$_FILES['pic']['size'];
	$ftype=$_FILES['pic']['type'];
	if($fsize>200*1024)
	{
		echo "<script>
		alert('图像大小超出限制');
		location.history(-1)';
		</script>";
		exit;
	}
	if($ftype!="image/jpeg"&&$ftype!=="image/jpeg")
	{
		echo "<script>
		alert('图像格式错误');
		location.history(-1)';
		</script>";
		exit;
	}
	move_uploaded_file($_FILES['pic']['tmp_name'],$xm."jpg");
?>
<table width="485" height="196" border="0" align="center" cellpadding="0" cellspacing="0" class="bk">
  <tr>
    <td height="35" colspan="3" align="center" bgcolor="#CCCCCC">注册信息</td>
  </tr>
  <tr>
    <td width="98" height="39" align="center">姓名：</td>
    <td width="230"><?php echo $xm;?></td>
    <td width="155" rowspan="4" align="center" class="bk"><img name="pic" src="<?php echo $xm."jpg";?>" width="120" height="150" alt=""></td>
  </tr>
  <tr>
    <td height="45" align="center">密码：</td>
    <td><?php echo $mm;?></td>
  </tr>
  <tr>
    <td height="39" align="center">性别：</td>
    <td><?php echo $xb;?></td>
  </tr>
  <tr>
    <td align="center">电话：</td>
    <td><?php echo $tel;?></td>
  </tr>
</table>
