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
<table width="100%" height="30" border="0" align="center" cellpadding="0" cellspacing="0" id="tlist">
    <tr>
      <td width="62%" height="30"  bgcolor="#FCFCC5">实训室设备情况数据</td>
      <td width="38%" height="30"  bgcolor="#FCFCC5">
	<?php 
	session_start();
	include("../db_connect.php");
	//查出所负责的实训室
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//记住 url	
	$sqls_lab_admin="select distinct(s_shi_index) from s_shixunshi where s_shi_admin=".$_SESSION['uid'];
	$rs_lab_admin=mysql_query($sqls_lab_admin,$conn);
	for($i=0;$i<mysql_num_rows($rs_lab_admin);$i++)
	{
		$arr_lab_admin=mysql_fetch_array($rs_lab_admin);
		$labs[$i]=$arr_lab_admin['s_shi_index'];//实训室编号数组
	}
	if(count($labs)==0)
		echo "请联系实训中心给您分配实训室";
	else
	{
	?>
      <form action="machine_data_list.php" method="post" name="form1" id="form1">
        <?php 
	 echo "请选择要浏览的实训室：";
	 foreach($labs as $v){?>
        <label>
          <input type="radio" name="lab" value="<?php echo $v;?>" id="lab_0" />
          <?php echo $v;?></label>
        <?php }?>
        <input type="submit" name="button" id="button" value="确定" />
      </form>
      <?php }?>
      </td>
    </tr>
  </table>
<?php
	if($_SESSION['uright']!=2)
		exit;
	mysql_query("SET NAMES 'UTF8'");	//转换编码
	if(isset($_GET['p']))
		$p=$_GET['p'];
	else
		$p=1;
	if(isset($_GET['st']))
	{
		$s_t=$_GET['st'];
		$s_k=$_GET['sk'];
	}
	else
	{
		$s_k='l_time';
		$s_t="desc";
	}
	if(isset($_POST['lab']))//获取所要浏览的实训室号
	{
		$d=$_POST['lab'];
		$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.'lab='.$d;
		$_SESSION['url']=$url;
	}
	if(isset($_GET['lab']))
		$d=$_GET['lab'];
	if(!isset($d)||$d=="")
		exit;
	$arr_w=array("星期天","星期一","星期二","星期三","星期四","星期五","星期六");
	$sqls_list="select * from s_using_list  where l_shi_id='".$d."' order by ".$s_k." ".$s_t;
	$rs=mysql_query($sqls_list,$conn);
	$total=mysql_num_rows($rs);
	$page_count=ceil($total/12);
	$offset=($p-1)*12;
	$sqls_list="select * from s_using_list  where l_shi_id='".$d."' order by ".$s_k." ".$s_t." limit ".$offset.",12";
	$rs_list=mysql_query($sqls_list,$conn);
	if($rs_list&&mysql_num_rows($rs_list)>0)
	{
?>
<table width="100%" height="67" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist">
  <tr>
    <td width="43" align="center" bgcolor="#CCCCCC" height="30">序号</td>
    <td width="81" align="center" bgcolor="#CCCCCC">
    <?php if($s_t=="asc"&&$s_k=='l_zhou')
    	echo "<a href='machine_data_list.php?st=desc&sk=l_zhou&lab=".$d."' class='field_sort'>周次↓</a>";
		else if($s_t=="desc"&&$s_k=='l_zhou')
    	echo "<a href='machine_data_list.php?st=asc&sk=l_zhou&lab=".$d."' class='field_sort'>周次↑</a>";
		else
    	echo "<a href='machine_data_list.php?st=desc&sk=l_zhou&lab=".$d."' class='field_sort'>周次</a>";
	?>
    </td>
    <td width="81" align="center" bgcolor="#CCCCCC">
    <?php if($s_t=="asc"&&$s_k=='l_xingqi')
    	echo "<a href='machine_data_list.php?st=desc&sk=l_xingqi&lab=".$d."' class='field_sort'>星期↓</a>";
		else if($s_t=="desc"&&$s_k=='l_xingqi')
    	echo "<a href='machine_data_list.php?st=asc&sk=l_xingqi&lab=".$d."' class='field_sort'>星期↑</a>";
		else
    	echo "<a href='machine_data_list.php?st=desc&sk=l_xingqi&lab=".$d."' class='field_sort'>星期</a>";
	?>
    </td>
    <td width="98" align="center" bgcolor="#CCCCCC">
    <?php if($s_t=="asc"&&$s_k=='l_node')
    	echo "<a href='machine_data_list.php?st=desc&sk=l_node&lab=".$d."' class='field_sort'>节次↓</a>";
		else if($s_t=="desc"&&$s_k=='l_node')
    	echo "<a href='machine_data_list.php?st=asc&sk=l_node&lab=".$d."' class='field_sort'>节次↑</a>";
		else
    	echo "<a href='machine_data_list.php?st=desc&sk=l_node&lab=".$d."' class='field_sort'>节次</a>";
	?>
    </td>
    <td width="105" align="center" bgcolor="#CCCCCC">
    <?php if($s_t=="asc"&&$s_k=='l_class')
    	echo "<a href='machine_data_list.php?st=desc&sk=l_class&lab=".$d."' class='field_sort'>上课班级↓</a>";
		else if($s_t=="desc"&&$s_k=='l_class')
    	echo "<a href='machine_data_list.php?st=asc&sk=l_class&lab=".$d."' class='field_sort'>上课班级↑</a>";
		else
    	echo "<a href='machine_data_list.php?st=desc&sk=l_class&lab=".$d."' class='field_sort'>上课班级</a>";
	?>
    </td>
    <td width="86" align="center" bgcolor="#CCCCCC">
    <?php if($s_t=="asc"&&$s_k=='l_shi_id')
    	echo "<a href='machine_data_list.php?st=desc&sk=l_shi_id&lab=".$d."' class='field_sort'>实训室↓</a>";
		else if($s_t=="desc"&&$s_k=='l_shi_id')
    	echo "<a href='machine_data_list.php?st=asc&sk=l_shi_id&lab=".$d."' class='field_sort'>实训室↑</a>";
		else
    	echo "<a href='machine_data_list.php?st=desc&sk=l_shi_id&lab=".$d."' class='field_sort'>实训室</a>";
	?>
    </td>
    <td width="127" align="center" bgcolor="#CCCCCC">机器名称</td>
    <td width="120" align="center" bgcolor="#CCCCCC">设备名称</td>
    <td width="100" align="center" bgcolor="#CCCCCC">
    <?php if($s_t=="asc"&&$s_k=='l_m_pro')
    	echo "<a href='machine_data_list.php?st=desc&sk=l_m_pro&lab=".$d."' class='field_sort'>运行情况↓</a>";
		else if($s_t=="desc"&&$s_k=='l_m_pro')
    	echo "<a href='machine_data_list.php?st=asc&sk=l_m_pro&lab=".$d."' class='field_sort'>运行情况↑</a>";
		else
    	echo "<a href='machine_data_list.php?st=desc&sk=l_m_pro&lab=".$d."' class='field_sort'>运行情况</a>";
	?>
    </td>
    <td width="188" align="center" bgcolor="#CCCCCC">
    <?php if($s_t=="asc"&&$s_k=='l_time')
    	echo "<a href='machine_data_list.php?st=desc&sk=l_time&lab=".$d."' class='field_sort'>登记时间↓</a>";
		else if($s_t=="desc"&&$s_k=='l_time')
    	echo "<a href='machine_data_list.php?st=asc&sk=l_time&lab=".$d."' class='field_sort'>登记时间↑</a>";
		else
    	echo "<a href='machine_data_list.php?st=desc&sk=l_time&lab=".$d."' class='field_sort'>登记时间</a>";
	?>
    </td>
    <td width="80" align="center" bgcolor="#CCCCCC">
    <?php if($s_t=="asc"&&$s_k=='l_teacher')
    	echo "<a href='machine_data_list.php?st=desc&sk=l_teacher&lab=".$d."' class='field_sort'>登记老师↓</a>";
		else if($s_t=="desc"&&$s_k=='l_teacher')
    	echo "<a href='machine_data_list.php?st=asc&sk=l_teacher&lab=".$d."' class='field_sort'>登记老师↑</a>";
		else
    	echo "<a href='machine_data_list.php?st=desc&sk=l_teacher&lab=".$d."' class='field_sort'>登记老师</a>";
	?>
    </td>
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
    <td align="center"><?php echo $arr_list['l_teacher'];?></td>
  </tr>
  <?php }?>
    <tr>
    <td height="34"  colspan="13" align="center" bgcolor="#FFFFFF">
    <?php	//页码
	for($i=1;$i<=$page_count;$i++)
	{
		echo "<a href='machine_data_list.php?p=".$i."&st=".$s_t."&sk=".$s_k."&lab=".$d."' class='page'>".$i."</a>";
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
	echo "暂时没有本实训室的使用数据";
?>
