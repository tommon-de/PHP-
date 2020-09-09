<link href="css.css" rel="stylesheet" type="text/css" />
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
<script language='javascript'>
function print_data()	//打印代码
{
	var print_tb=document.getElementById("tprint");
	var newWin=window.open("");
	newWin.document.write(print_tb.outerHTML);
	newWin.document.close();
	newWin.focus();
	newWin.print();
}
</script>
<table width="100%" height="30" border="0" align="center" cellpadding="0" cellspacing="0" id="ttop">
    <tr>
      <td width="58%" height="30"  bgcolor="#FCFCC5">实训室设备情况数据</td>
      <td width="33%" height="30"  bgcolor="#FCFCC5">
<?php 
	session_start();
	include("db_connect.php");
	//数据查询函数
	  $print_class="";
	  $print_gz="";
	  $print_teacher="";
	  $print_rs="";
	  $print_nr="";
	function out_data($jie,$d,$p,$k,$conn)
	{
	  global $print_class;
	  global $print_gz;
	  global $print_teacher;
	  global $print_rs;
	  global $print_nr;
	  $print_class="";
	  $print_gz="";
	  $print_teacher="";
	  $print_rs="";
	  $print_nr="";
		$sqls_list="select * from output where l_shi_id='".$d."' and l_zhou=".$p." and l_xingqi=".$k." and l_node='".$jie."' order by l_xingqi asc,l_node asc";
		$rs_list=mysql_query($sqls_list,$conn);
		if($rs_list&&mysql_num_rows($rs_list)>0)
		{
			for($i=0;$i<mysql_num_rows($rs_list);$i++)
			{
				$arr_list=mysql_fetch_array($rs_list);
				$print_class=$arr_list['l_class'];
				$print_teacher=$arr_list['l_teacher'];
				$print_rs=$arr_list['c_stu_num'];
				//查出该节课的课程内容
				$sqls_course="select p_lesson from s_class_plan where p_shi_id='".$d."' and p_xingqi=".$k." and p_node='".$jie."'";
				$rs_course=mysql_query($sqls_course,$conn);
				if($rs_course&&mysql_num_rows($rs_course)>0)
				{
					$arr_course=mysql_fetch_array($rs_course);
					$print_nr=$arr_course['p_lesson'];
				}
				else
					$print_nr="/";
				if($arr_list['l_m_name']=="全部")
					$print_gz.=$arr_list['l_m_name']."正常&nbsp;";
				else
					$print_gz.=$arr_list['l_m_name'].$arr_list['l_c_name'].$arr_list['l_m_pro']."&nbsp;";
			}
		mysql_free_result($rs_list);	//释放记录集
		}
		else
		{
		  $print_class="";
		  $print_gz="";
		  $print_teacher="";
		  $print_rs="";
		  $print_nr="";
		}
	}
	//查出所负责的实训室
	if($_SESSION['uright']==2)
		$sqls_lab_admin="select distinct(s_shi_index) from s_shixunshi where s_shi_admin=".$_SESSION['uid'];
	elseif($_SESSION['uright']==1)
		$sqls_lab_admin="select distinct(s_shi_index) from s_shixunshi";
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
      <form action="data_print.php" method="post" name="form1" id="form1">
        <?php 
	 echo "请选择要打印的实训室：";?><select name="lab">
	<?php  foreach($labs as $v){?>
        
          <option  value="<?php echo $v;?>"/><?php echo $v;?></option>
        <?php }?></select>
        <input type="submit" name="button" id="button" value="确定" />
      </form>
      <?php }?>
      </td>
      <td width="9%" align="center"  bgcolor="#FCFCC5"><input type="button" name="button2" id="button2" value="打印输出"  onclick="print_data();"/></td>
    </tr>
  </table>
<?php
	mysql_query("SET NAMES 'UTF8'");	//转换编码
	if(isset($_GET['p']))
		$p=$_GET['p'];
	else
		$p=1;
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
	$arr_node=array('12','34','56','78');//节次
?>
<table width="1000" height="274" border="1" align="center" cellpadding="0" cellspacing="0" id="tprint">
  <tr>
    <td height="48" colspan="8" align="center" bgcolor="#FFFFFF" ><span id="out_title">实验实训室使用情况记表</span></td>
  </tr>
  <tr>
    <td height="32" colspan="8" align="center" bgcolor="#FFFFFF" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="39%" height="25" align="center">使用时间：第学期第　　<?php echo $p;?>　周 </td>
        <td width="27%" align="center">&nbsp;</td>
        <td width="34%" align="center">年 　　　月 　　　日至 　　日</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="36" align="center" bgcolor="#FFFFFF" >星期</td>
    <td height="36" align="center" bgcolor="#FFFFFF" >节次</td>
    <td height="36" align="center" bgcolor="#FFFFFF" >使用班级</td>
    <td height="36" align="center" bgcolor="#FFFFFF" >人数</td>
    <td height="36" align="center" bgcolor="#FFFFFF" >实验实训内容</td>
    <td height="36" align="center" bgcolor="#FFFFFF" >设备完好情况</td>
    <td height="36" align="center" bgcolor="#FFFFFF" >教师签名</td>
    <td width="96" height="36" align="center" bgcolor="#FFFFFF" >备注</td>
  </tr>
  <?php
  foreach($arr_w as $k=>$w)	//逐条查出数据填入表格
  { 
?>
  <tr class="hang">
    <td width="77" height="36" rowspan="5" align="center" ><?php echo $w;?></td>
    <td width="58" height="36" align="center" >1/2</td>
    <?php
	  out_data('12',$d,$p,$k,$conn);
	?>
    <td width="87" align="center" height="36"><?php echo $print_class;?></td>
    <td width="59" align="center" height="36"><?php echo $print_rs;?></td>
    <td width="172" align="center" height="36"><?php echo $print_nr;?></td>
    <td width="468" height="36"><?php echo $print_gz;?></td>
    <td width="95" align="center" height="36"><?php echo $print_teacher;?></td>
    <td align="center" >&nbsp;</td>
  </tr>
  <tr class="hang">
    <td height="36" align="center" >3/4</td>
    <?php
	out_data("34",$d,$p,$k,$conn);
	?>
    <td width="87" align="center" height="36"><?php echo $print_class;?></td>
    <td width="59" align="center" height="36"><?php echo $print_rs;?></td>
    <td width="172" align="center" height="36"><?php echo $print_nr;?></td>
    <td width="468" height="36"><?php echo $print_gz;?></td>
    <td width="95" align="center" height="36"><?php echo $print_teacher;?></td>
    <td align="center" >&nbsp;</td>
  </tr>
  <tr class="hang">
    <td height="36" align="center" >5/6</td>
    <?php
	out_data("56",$d,$p,$k,$conn);
	?>
    <td width="87" align="center" height="36"><?php echo $print_class;?></td>
    <td width="59" align="center" height="36"><?php echo $print_rs;?></td>
    <td width="172" align="center" height="36"><?php echo $print_nr;?></td>
    <td width="468" height="36"><?php echo $print_gz;?></td>
    <td width="95" align="center" height="36" ><?php echo $print_teacher;?></td>
    <td align="center" >&nbsp;</td>
  </tr>
  <tr class="hang">
    <td height="36" align="center" >7/8</td>
    <?php
	 out_data("78",$d,$p,$k,$conn);
	?>
    <td width="87" align="center" height="36"><?php echo $print_class;?></td>
    <td width="59" align="center" height="36"><?php echo $print_rs;?></td>
    <td width="172" align="center" height="36"><?php echo $print_nr;?></td>
    <td width="468" height="36"><?php echo $print_gz;?></td>
    <td width="95" align="center" height="36"><?php echo $print_teacher;?></td>
    <td align="center" >&nbsp;</td>
  </tr>
  <tr class="hang">
    <td height="36" align="center" >&nbsp;</td>
    <td align="center" height="36">&nbsp;</td>
    <td align="center" height="36">&nbsp;</td>
    <td align="center" height="36">&nbsp;</td>
    <td height="36">&nbsp;</td>
    <td align="center" height="36">&nbsp;</td>
    <td align="center" height="36">&nbsp;</td>
  </tr>
  <?php 
	   }?>
  </table>
  <p>&nbsp;</p>
  <table width="100%" height="84" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist">
    <tr>
    <td height="82"  align="center" bgcolor="#FFFFFF">
    <?php	//页码
	for($i=1;$i<=18;$i++)
	{
		echo "<a href='data_print.php?p=".$i."&lab=".$d."' class='page'>第".$i."周</a>";
		if($i==9)
			echo "<p>";
		echo "&nbsp;";
	}
	?>    
    </td>
  </tr>
</table>
