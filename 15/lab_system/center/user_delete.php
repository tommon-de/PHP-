<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="49">
<?php
//删除用户
	include("../db_connect.php");
	$dele_id=$_GET['uid'];
	$sqls_dele="delete from s_user where u_id=".$dele_id;
	$rs_dele=mysql_query($sqls_dele,$conn);
	if($rs_dele)
	{
		echo "一条用户信息删除完成";
		echo "<a href='userinfo_list.php'>返回</a>";
	}
	else
	{
		echo "一条用户信息删除失败";
		echo "<a href='userinfo_list.php'>返回</a>";
	}
?>
    </td>
  </tr>
</table>
