<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改班级信息</title>
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
	mysql_query("SET NAMES 'UTF8'");
	$cid=$_GET['cid'];
	$sqls="select * from s_class where c_id='".$cid."'";
	$rs_class=mysql_query($sqls,$conn);
	$arr_class=mysql_fetch_array($rs_class);
?>
<form id="form1" name="form1" method="post" action="class_info_edit_save.php?cid=<?php echo $cid;?>">
  <table width="100%" height="257" border="0" align="center" cellpadding="0" cellspacing="0" id="tinfo">
    <tr>
      <td height="36" colspan="2" bgcolor="#CCCCCC"> 中心管理》班级基础信息录入</td>
    </tr>
    <tr>
      <td width="173" height="39" align="center" bgcolor="#FFFFFF">班级编号</td>
      <td width="844" bgcolor="#FFFFFF"><label for="c_id"></label>
      <input type="text" name="c_id" id="c_id"  value="<?php echo $arr_class['c_id'];?>"/>
      *格式：Z16F34 || C16F34</td>
    </tr>
    <tr>
      <td height="39" align="center" bgcolor="#FFFFFF">班级名称</td>
      <td bgcolor="#FFFFFF"><input type="text" name="c_name" id="c_name" value="<?php echo $arr_class['c_name'];?>"/></td>
    </tr>
    <tr>
      <td height="34" align="center" bgcolor="#FFFFFF">人数</td>
      <td bgcolor="#FFFFFF"><label for="c_num"></label>
      <input type="text" name="c_num" id="c_num"  value="<?php echo $arr_class['c_stu_num'];?>"/></td>
    </tr>
    <tr>
      <td height="38" align="center" bgcolor="#FFFFFF">班主任</td>
      <td bgcolor="#FFFFFF"><input type="text" name="c_master" id="c_master"  value="<?php echo $arr_class['c_master'];?>"/></td>
    </tr>
    <tr>
      <td height="31" align="center" bgcolor="#FFFFFF">班级类型</td>
      <td bgcolor="#FFFFFF">
      <label for="c_type"></label>
        <select name="c_type" id="c_type">
        <option value="0" <?php if($arr_class['c_type']==0){?> selected="selected"<?php }?>>校内班级</option>
        <option value="1"<?php if($arr_class['c_type']==1){?> selected="selected"<?php }?>>社会班级</option>
      </select>
      </td>
    </tr>
    <tr>
      <td height="40" colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" name="button" id="button" value="保存班级信息" />
      　　
        <input type="button" name="import" id="import" value="导入班级信息" /></td>
    </tr>
  </table>
</form>
</body>
</html>