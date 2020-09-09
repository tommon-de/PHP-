<?php session_start();?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="49">
<?php
//删除实训室基础数据
	include("../db_connect.php");
	$dele_id=$_GET['mid'];
	$sqls_dele="delete from s_machine where m_id=".$dele_id;
	$rs_dele=mysql_query($sqls_dele,$conn);
	if($rs_dele)
	{
		echo "一条实训设备数据删除完成";
		echo "<a href='".$_SESSION['url']."'>返回</a>";
	}
	else
	{
		echo "一条实训设备删除失败";
		echo "<a href='".$_SESSION['url']."'>返回</a>";
	}
?>
    </td>
  </tr>
</table>
