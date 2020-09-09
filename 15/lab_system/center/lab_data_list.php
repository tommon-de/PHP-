<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>实训室数据汇总</title>
<link href="../css.css" rel="stylesheet" type="text/css" />

<style type="text/css">
#tlist {
	background-color: #CCC;
	font-size: 14px;
	color: #036;
	text-decoration: none;
}
.hang
{
	background-color:#FFF;
}
.hang:hover{
	background-color:#D6EEBD;}
body {
	margin-left: 0px;
	margin-top: 0px;
}
</style>
</head>

<body>
<table width="100%" height="30" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#EAEAEA">中心管理》实训室数据汇总</td>
  </tr>
</table>
<table width="100%" height="94" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist">
  <tr>
    <td width="52" align="center" bgcolor="#E3E3E3" height="30">序号</td>
    <td width="91" align="center" bgcolor="#E3E3E3">实训室编号</td>
    <td width="119" align="center" bgcolor="#E3E3E3">利用率</td>
    <td width="119" align="center" bgcolor="#E3E3E3">故障率</td>
    <td width="135" align="center" bgcolor="#E3E3E3">校内课时数</td>
    <td width="128" align="center" bgcolor="#E3E3E3">校内班级数</td>
    <td width="122" align="center" bgcolor="#E3E3E3">校内实训人次</td>
    <td width="122" align="center" bgcolor="#E3E3E3">校外课时数</td>
    <td width="118" align="center" bgcolor="#E3E3E3">校外班级数</td>
    <td width="106" align="center" bgcolor="#E3E3E3">校外实训人次</td>
  </tr>
<?php
	session_start();
	include("../db_connect.php");
	if($_SESSION['uright']!=1)
		exit;
	mysql_query("SET NAMES 'UTF8'");	//转换编码
	//分页程序
	if(isset($_GET['p']))
		$p=$_GET['p'];
	else
		$p=1;
	$sqls_list="select * from s_shixunshi order by s_shi_index asc";
	$rs=mysql_query($sqls_list,$conn);
	$total=mysql_num_rows($rs);
	$page_count=ceil($total/12);
	$offset=($p-1)*12;
	$sqls_list="select * from s_shixunshi order by s_shi_index asc limit ".$offset.",12";
	$rs_list=mysql_query($sqls_list,$conn);
	if($rs_list&&mysql_num_rows($rs_list)>0)
	{
		//数据统计
	 for($i=0;$i<mysql_num_rows($rs_list);$i++)
	  {
	  $arr_list=mysql_fetch_array($rs_list);
	  $total_ks=0;	//总上课课时
	  $total_gz=0;	//总故障数
	  $gz_person=0;	//故障率
	  $total_xnbj=0;	//总校内班级
	  $total_xnks=0;	//总校内课时
	  $total_xnrc=0;	//总校内人次
	  $total_xwbj=0;	//总校外班级
	  $total_xwks=0;	//总校外课时
	  $total_xwrc=0;	//总校外人次
	  //统计各个实训室的数据
	  //利率率,学期总课时为38*20；
	  $sqls_ks="select p_node from s_class_plan where p_shi_id='".$arr_list['s_shi_index']."'";
	  $rs_ks=mysql_query($sqls_ks,$conn);
	  if(!$rs_ks||mysql_num_rows($rs_ks)==0)
	  	$total_ks=0;
	  else
	  {
		  for($j=0;$j<mysql_num_rows($rs_ks);$j++)
		  {
			  $temp=mysql_fetch_array($rs_ks);
			  $total_ks+=strlen($temp['p_node']);
		  }
		  mysql_free_result($rs_ks);
	  }
	  //故障率
	  $sqls_gz="select l_m_pro from s_using_list where l_shi_id='".$arr_list['s_shi_index']."'";
	  $rs_gz=mysql_query($sqls_gz,$conn);
	  if(!$rs_gz||mysql_num_rows($rs_gz)==0)
	  {
	  	$total_gz=0;
		$gz_person=0;
	  }
	  else
	  {
		  for($j=0;$j<mysql_num_rows($rs_gz);$j++)
		  {
			  $temp=mysql_fetch_array($rs_gz);
			  if($temp['l_m_pro']=='故障')
			  	$total_gz+=1;
		  }
		  $gz_person=round((100*$total_gz/mysql_num_rows($rs_gz)));
		  mysql_free_result($rs_gz);
	  }
	  
	  //校内班级、人数、课时以及校外班级、人数、课时
	  $sqls_bj="select distinct(p_class_id) from s_class_plan where p_shi_id='".$arr_list['s_shi_index']."'";
	  $rs_bj=mysql_query($sqls_bj,$conn);
	  if(!isset($rs_bj)||mysql_num_rows($rs_bj)==0)
	  {
		  $total_xnbj=0;
		  $total_xnrc=0;
		  $total_xnks=0;
		  $total_xwbj=0;
		  $total_xwks=0;
		  $total_xwrc=0;
	  }
	  else
	  {
		  for($j=0;$j<mysql_num_rows($rs_bj);$j++)
		  {
			  $temp=mysql_fetch_array($rs_bj);
			  $sqls_count="select c_stu_num,c_type from s_class where c_id='".$temp['p_class_id']."'";
			  $rs_count=mysql_query($sqls_count,$conn);
			  $arr_count=mysql_fetch_array($rs_count);
			  if($arr_count['c_type']==0)	//校内班级
			  {
				  $total_xnbj+=1;	//校内班级数
				  $total_xnrc+=$arr_count['c_stu_num'];//校内人次
				  $sqls_count_xn="select p_node from s_class_plan where p_shi_id='".$temp['p_class_id']."'";
				  $rs_count_xn=mysql_query($sqls_count_xn,$conn);
				  for($m=0;$m<mysql_num_rows($rs_count_xn);$m++)
				  {
					  $js=mysql_fetch_array($rs_count_xn);
					  $total_xnks+=strlen($js['p_node']);
				  }
				  mysql_free_result($rs_count_xn);
			  }
			  else
			  {
				  $total_xwbj+=1;//校外班级数
				  $total_xwrc+=$arr_count['c_stu_num'];//校外人次
				  $sqls_count_xw="select p_node from s_class_plan where p_shi_id='".$temp['p_class_id']."'";
				  $rs_count_xw=mysql_query($sqls_count_xw,$conn);
				  for($m=0;$m<mysql_num_rows($rs_count_xw);$m++)
				  {
					  $js=mysql_fetch_array($rs_count_xw);
					  $total_xwks+=strlen($js['p_node']);
				  }
				  mysql_free_result($rs_count_xw);
			  }
		  }
		  mysql_free_result($rs_bj);
		  
	  }
	  
	  ?>
  <tr class="hang">
    <td align="center" height="30"><?php echo ($i+1);?></td>
    <td align="center"><?php echo $arr_list['s_shi_index'];?></td>
    <td align="center">
	<?php 
	if(round(100*$total_ks/(38*20))<60)
		echo "<span style='background-color:#f22;padding:2px 15px'>".round(100*$total_ks/(38*20))."%</span>";
	elseif(round(100*$total_ks/(38*20))>90)
		echo "<span style='background-color:#0f2;padding:2px 15px'>".round(100*$total_ks/(38*20))."%</span>";
	else
		echo round(100*$total_ks/(38*20))."%";
	?>
    </td>
    <td align="center">
	<?php 
	if($gz_person>60)
		echo "<span style='background-color:#f22;padding:2px 15px'>".$gz_person."%</span>";
	elseif($gz_person<5)
		echo "<span style='background-color:#0f2;padding:2px 15px'>".$gz_person."%</span>";
	else
		echo $gz_person."%";
	?>
    </td>
    <td align="center"><?php echo $total_xnks;?></td>
    <td align="center"><?php echo $total_xnbj;?></td>
    <td align="center"><?php echo $total_xnrc;?></td>
    <td align="center"><?php echo $total_xwks;?></td>
    <td align="center"><?php echo $total_xwbj;?></td>
    <td align="center"><?php echo $total_xwrc;?></td>
  </tr>  
  <?php }?>
  <tr>
    <td height="30" colspan="10" align="center">
    <?php	//页码
	for($i=1;$i<=$page_count;$i++)
	{
		echo "<a href='lab_data_list.php?p=".$i."' class='page'>".$i."</a>&nbsp;";
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
	echo "暂无任何实训室数据";
?>
</body>
</html>