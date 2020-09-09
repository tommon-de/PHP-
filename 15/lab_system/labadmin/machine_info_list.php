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

<table width="100%" height="25" border="0" align="center" cellpadding="0" cellspacing="0" id="lab_select">
  <tr>
    <td width="60%" height="25" >实训室设备配件列表</td> 
    <td  width="40%" height="25">
<?php
	session_start();
	include("../db_connect.php");
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
		$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		$_SESSION['url']=$url;	//记住 url	
	}
	else
	{
		$s_k='m_name';
		$s_t="desc";
	}
	//查出当前管理员所负责的实训室
	$sqls_lab_admin="select distinct(s_shi_index) from s_shixunshi where s_shi_admin=".$_SESSION['uid'];
	$rs_lab_admin=mysql_query($sqls_lab_admin,$conn);
	for($i=0;$i<mysql_num_rows($rs_lab_admin);$i++)
	{
		$arr_lab_admin=mysql_fetch_array($rs_lab_admin);
		$labs[$i]=$arr_lab_admin['s_shi_index'];//实训室编号数组
	}
?>
    <?php if(count($labs)==0)
		echo "请联系实训中心给您分配实训室";
	else
	{
	?>
    <form name="form1" method="post" action="machine_info_list.php">
     <?php 
	 echo "请选择要浏览的实训室：";
	 foreach($labs as $v){?>
        <label>
          <input type="radio" name="lab" value="<?php echo $v;?>" id="lab_0">
          <?php echo $v;?></label><?php }?>
        <input type="submit" name="button" id="button" value="确定">
    </form>
    <?php }?>
    </td>
  </tr>
</table>
<?php 
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
	$sqls_list="select * from s_machine  where m_shi_id='".$d."' order by ".$s_k." ".$s_t;
	$rs=mysql_query($sqls_list,$conn);
	$total=mysql_num_rows($rs);
	$page_count=ceil($total/12);
	$offset=($p-1)*12;
	$sqls_list="select * from s_machine  where m_shi_id='".$d."' order by ".$s_k." ".$s_t." limit ".$offset.",12";
	$rs_list=mysql_query($sqls_list,$conn);
	if($rs_list&&mysql_num_rows($rs_list)>0)
	{
?>
<table width="100%" height="67" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist">
  <tr>
    <td width="110" align="center" bgcolor="#CCCCCC" height="30">序号</td>
    <td width="303" align="center" bgcolor="#CCCCCC">实训室编号</td>
    <td width="257" align="center" bgcolor="#CCCCCC">
    <?php if($s_t=="asc"&&$s_k=='m_name')
    	echo "<a href='machine_info_list.php?st=desc&sk=m_name&lab=".$d."' class='field_sort'>机器名称↓</a>";
		else if($s_t=="desc"&&$s_k=='m_name')
    	echo "<a href='machine_info_list.php?st=asc&sk=m_name&lab=".$d."' class='field_sort'>机器名称↑</a>";
		else
    	echo "<a href='machine_info_list.php?st=desc&sk=m_name&lab=".$d."' class='field_sort'>机器名称</a>";
	?>
    </td>
    <td width="325" align="center" bgcolor="#CCCCCC">
    <?php if($s_t=="asc"&&$s_k=='m_bujian')
    	echo "<a href='machine_info_list.php?st=desc&sk=m_bujian&lab=".$d."' class='field_sort'>配件名称↓</a>";
		else if($s_t=="desc"&&$s_k=='m_bujian')
    	echo "<a href='machine_info_list.php?st=asc&sk=m_bujian&lab=".$d."' class='field_sort'>配件名称↑</a>";
		else
    	echo "<a href='machine_info_list.php?st=desc&sk=m_bujian&lab=".$d."' class='field_sort'>配件名称</a>";
	?>
    </td>
    <td width="120" align="center" bgcolor="#CCCCCC">操作</td>
  </tr>
  <?php 
  for($i=0;$i<mysql_num_rows($rs_list);$i++)
  {
	  $arr_list=mysql_fetch_array($rs_list);
?>
  <tr class="hang">
    <td align="center" height="30"><?php echo ($i+1);?></td>
    <td align="center"><?php echo $d;?></td>
    <td align="center"><?php echo $arr_list['m_name'];?></td>
    <td align="center"><?php echo $arr_list['m_bujian'];?></td>
    <td align="center"><a href="machine_info_dele.php?mid=<?php echo $arr_list['m_id'];?>">删除</a></td>
  </tr>
  <?php } ?>
    <tr>
    <td height="34"  colspan="8" align="center" bgcolor="#FFFFFF">
    <?php	//页码
	for($i=1;$i<=$page_count;$i++)
	{
		echo "<a href='machine_info_list.php?p=".$i."&st=".$s_t."&sk=".$s_k."&lab=".$d."' class='page'>".$i."</a>";
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
