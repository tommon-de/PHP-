<link href="../css.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#tlist {
	background-color: #EAEAEA;
	font-size: 14px;
	color: #036;
	text-decoration: none;
}
body {
	margin-left: 0px;
	margin-top: 0px;
}
</style>
<table width="100%" height="37" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist">
    <tr>
      <td width="85%" height="35"  bgcolor="#E0E0E0">实训室设备情况登记》我的登记</td>
      <td width="15%"  bgcolor="#E0E0E0"><a href="use_date_select.php" class="addnew">添加使用登记</a></td>
    </tr>
  </table>
<?php
	session_start();
	include("../db_connect.php");
	if($_SESSION['uright']!=3)
		exit;
	mysql_query("SET NAMES 'UTF8'");	//转换编码
	
	if(isset($_GET['p']))	//获取当前分页的页码
		$p=$_GET['p'];
	else
		$p=1;
	if(isset($_GET['st']))	//排序方式与排序字段
	{
		$s_t=$_GET['st'];
		$s_k=$_GET['sk'];
	}
	else
	{
		$s_k='l_time';
		$s_t="desc";
	}
	$arr_w=array("星期天","星期一","星期二","星期三","星期四","星期五","星期六");
	$sqls_list="select * from s_using_list  where l_teacher='".$_SESSION['truename']."' order by ".$s_k." ".$s_t;
	$rs=mysql_query($sqls_list,$conn);
	$total=mysql_num_rows($rs);
	$page_count=ceil($total/12);
	$offset=($p-1)*12;
	$sqls_list="select * from s_using_list  where l_teacher='".$_SESSION['truename']."' order by ".$s_k." ".$s_t." limit ".$offset.",12";
	$rs_list=mysql_query($sqls_list,$conn);
	if($rs_list&&mysql_num_rows($rs_list)>0)
	{
?>
<table width="100%" height="67" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist">
  <tr>
    <td width="44" align="center" bgcolor="#CCCCCC" height="30">序号</td>
    <td width="94" align="center" bgcolor="#CCCCCC">
    <?php if($s_t=="asc"&&$s_k=='l_zhou')
    	echo "<a href='use_data_list.php?st=desc&sk=l_zhou' class='field_sort'>周次↓</a>";
		else if($s_t=="desc"&&$s_k=='l_zhou')
    	echo "<a href='use_data_list.php?st=asc&sk=l_zhou' class='field_sort'>周次↑</a>";
		else
    	echo "<a href='use_data_list.php?st=desc&sk=l_zhou' class='field_sort'>周次</a>";
	?>
    </td>
    <td width="89" align="center" bgcolor="#CCCCCC">
    <?php if($s_t=="asc"&&$s_k=='l_xingqi')
    	echo "<a href='use_data_list.php?st=desc&sk=l_xingqi' class='field_sort'>星期↓</a>";
		else if($s_t=="desc"&&$s_k=='l_xingqi')
    	echo "<a href='use_data_list.php?st=asc&sk=l_xingqi' class='field_sort'>星期↑</a>";
		else
    	echo "<a href='use_data_list.php?st=desc&sk=l_xingqi' class='field_sort'>星期</a>";
	?>
    </td>
    <td width="95" align="center" bgcolor="#CCCCCC">
    <?php if($s_t=="asc"&&$s_k=='l_node')
    	echo "<a href='use_data_list.php?st=desc&sk=l_node' class='field_sort'>节次↓</a>";
		else if($s_t=="desc"&&$s_k=='l_node')
    	echo "<a href='use_data_list.php?st=asc&sk=l_node' class='field_sort'>节次↑</a>";
		else
    	echo "<a href='use_data_list.php?st=desc&sk=l_node' class='field_sort'>节次</a>";
	?>
    </td>
    <td width="108" align="center" bgcolor="#CCCCCC">
    <?php if($s_t=="asc"&&$s_k=='l_class')
    	echo "<a href='use_data_list.php?st=desc&sk=l_class' class='field_sort'>上课班级↓</a>";
		else if($s_t=="desc"&&$s_k=='l_class')
    	echo "<a href='use_data_list.php?st=asc&sk=l_class' class='field_sort'>上课班级↑</a>";
		else
    	echo "<a href='use_data_list.php?st=desc&sk=l_class' class='field_sort'>上课班级</a>";
	?>
    </td>
    <td width="128" align="center" bgcolor="#CCCCCC">
    <?php if($s_t=="asc"&&$s_k=='l_shi_id')
    	echo "<a href='use_data_list.php?st=desc&sk=l_shi_id' class='field_sort'>实训室↓</a>";
		else if($s_t=="desc"&&$s_k=='l_shi_id')
    	echo "<a href='use_data_list.php?st=asc&sk=l_shi_id' class='field_sort'>实训室↑</a>";
		else
    	echo "<a href='use_data_list.php?st=desc&sk=l_shi_id' class='field_sort'>实训室</a>";
	?>
    </td>
    <td width="133" align="center" bgcolor="#CCCCCC">机器名称</td>
    <td width="90" align="center" bgcolor="#CCCCCC">设备名称</td>
    <td width="108" align="center" bgcolor="#CCCCCC">
    <?php if($s_t=="asc"&&$s_k=='l_m_pro')
    	echo "<a href='use_data_list.php?st=desc&sk=l_m_pro' class='field_sort'>故障描述↓</a>";
		else if($s_t=="desc"&&$s_k=='l_m_pro')
    	echo "<a href='use_data_list.php?st=asc&sk=l_m_pro' class='field_sort'>故障描述↑</a>";
		else
    	echo "<a href='use_data_list.php?st=desc&sk=l_m_pro' class='field_sort'>故障描述</a>";
	?>
    </td>
    <td width="155" align="center" bgcolor="#CCCCCC">
    <?php if($s_t=="asc"&&$s_k=='l_time')
    	echo "<a href='use_data_list.php?st=desc&sk=l_time' class='field_sort'>登记时间↓</a>";
		else if($s_t=="desc"&&$s_k=='l_time')
    	echo "<a href='use_data_list.php?st=asc&sk=l_time' class='field_sort'>登记时间↑</a>";
		else
    	echo "<a href='use_data_list.php?st=desc&sk=l_time' class='field_sort'>登记时间</a>";
	?>
    </td>
    <td width="67" align="center" bgcolor="#CCCCCC">删除</td>
  </tr>
  <?php for($i=0;$i<mysql_num_rows($rs_list);$i++)
  {
	  $arr_list=mysql_fetch_array($rs_list);
	  ?>
  <tr class="hang">
    <td align="center" height="30"><?php echo ($i+1);?></td>
    <td align="center"><?php echo "第".$arr_list['l_zhou']."周";?></td>
    <td align="center"><?php echo $arr_w[$arr_list['l_xingqi']];?></td>
    <td align="center"><?php echo "第".$arr_list['l_node']."节";
?></td>
    <td align="center"><?php echo $arr_list['l_class'];?></td>
    <td align="center"><?php echo $arr_list['l_shi_id'];?></td>
    <td align="center"><?php echo $arr_list['l_m_name'];?></td>
    <td align="center"><?php echo $arr_list['l_c_name'];?></td>
    <td align="center">
	<?php 
	if($arr_list['l_m_pro']=="正常")
		echo "<span style='color:#3F0'>".$arr_list['l_m_pro']."</span>";
	else
		echo "<span style='color:#F00'>".$arr_list['l_m_pro']."</span>";
	?>
    </td>
    <td align="center"><?php echo $arr_list['l_time'];?></td>
    <td align="center"><a href="use_data_dele.php?lid=<?php echo $arr_list['l_id'];?>">删除</a></td>
  </tr>
  <?php }?>
    <tr>
    <td height="34"  colspan="13" align="center" bgcolor="#FFFFFF">
    <?php	//页码
	for($i=1;$i<=$page_count;$i++)
	{
		echo "<a href='use_data_list.php?p=".$i."&st=".$s_t."&sk=".$s_k."' class='page'>".$i."</a>";
		echo "&nbsp;";
	}	
	?>    
    </td>
  </tr>
</table>
<?php 
	mysql_free_result($rs_list);	//释放记录集
	mysql_close($conn);
}
else
	echo "暂时找不到您登记的实训室使用数据";
?>
