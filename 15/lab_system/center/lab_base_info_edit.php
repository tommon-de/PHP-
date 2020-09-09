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
	//查出全部实训室管理员账号信息
	include("../db_connect.php");
	$iid=$_GET['iid'];
	mysql_query("SET NAMES 'UTF8'");
	$sqls_select="select u_id,u_true_name from s_user where u_right=2";
	$rs_admin=mysql_query($sqls_select,$conn);
	$sqls_lab="select * from s_shixunshi where s_id=".$iid;
	$rs_lab=mysql_query($sqls_lab,$conn);
	$arr_lab=mysql_fetch_array($rs_lab);
?>
<script language="javascript">
document.getElementById("l_time").value
</script>
<form id="form1" name="form1" method="post" action="Lab_base_info_edit_save.php?iid=<?php echo $iid;?>">
  <table width="100%" height="289" border="0" align="center" cellpadding="0" cellspacing="0" id="tinfo">
    <tr>
      <td height="36" colspan="2" bgcolor="#CCCCCC"> 中心管理》实训室基础信息修改</td>
    </tr>
    <tr>
      <td width="187" height="39" align="center" bgcolor="#FFFFFF">实训室编码</td>
      <td width="830" bgcolor="#FFFFFF"><label for="l_id"></label>
      <input type="text" name="l_id" id="l_id"  value="<?php echo $arr_lab['s_shi_index'];?>"/></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFFFF">工位数</td>
      <td bgcolor="#FFFFFF"><label for="l_seats"></label>
      <input type="text" name="l_seats" id="l_seats"  value="<?php echo $arr_lab['s_shi_seats'];?>"/></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFFFF">建成时间</td>
      <td bgcolor="#FFFFFF">
      <?php $l_time=$arr_lab['s_shi_finish_time']."T00:00:00"; ?>
      <input type="datetime-local" name="l_time" id="l_time" value="<?php echo $l_time;?>"/>
      </td>
    </tr>
    <tr>
      <td height="31" align="center" bgcolor="#FFFFFF">管理员</td>
      <td bgcolor="#FFFFFF">
      <?php 
	  if($rs_admin&&mysql_num_rows($rs_admin)>0)
	  {
	  ?>
      <label for="l_admin"></label>
        <select name="l_admin" id="l_admin">
        <?php
			for($i=0;$i<mysql_num_rows($rs_admin);$i++)
			{
				$arr_admin=mysql_fetch_array($rs_admin); 
				if($arr_admin['u_id']==$arr_lab['s_shi_admin'])
				{
		?>
        <option value="<?php echo $arr_admin['u_id'];?>" selected="selected"><?php echo $arr_admin['u_true_name'];?></option>
        <?php 
				}
		else
		{?>
        <option value="<?php echo $arr_admin['u_id'];?>" ><?php echo $arr_admin['u_true_name'];?></option>
		<?php }}?>
      </select>
      <?php 
	  mysql_free_result($rs_admin);	//释放记录集	  
	  }
	  else
	  	echo "暂无任何实训室管理员的账号信息，请先添加";	  
	  ?>
      </td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFFFF">主要设备名称</td>
      <td bgcolor="#FFFFFF"><label for="l_construct"></label>
      <input type="text" name="l_construct" id="l_construct"  value="<?php echo $arr_lab['s_shi_machine_name'];?>"/></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFFFF">设备型号</td>
      <td bgcolor="#FFFFFF"><label for="l_type"></label>
      <input type="text" name="l_type" id="l_type"  value="<?php echo $arr_lab['s_shi_machine_type'];?>"/></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFFFF">设备数量</td>
      <td bgcolor="#FFFFFF"><label for="l_num"></label>
      <input type="text" name="l_num" id="l_num"  value="<?php echo $arr_lab['s_shi_machine_num'];?>"/></td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" name="button" id="button" value="保存修改" /></td>
    </tr>
  </table>
</form>
</body>
</html>