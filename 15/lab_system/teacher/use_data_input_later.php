<link href="../css.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function addtolist()	//将各部件设备的运行情况添加到列表再提交
{
	var m_name=document.getElementById("machine").value;
	var c_name=document.getElementById("construct").value;
	if(document.getElementById("result_0").checked)
	{
		var m_result="正常";
	}
	else
	{
		var m_result="故障";
	}
	var list=document.getElementById("list");
	var rows=list.rows.length;
	var row=list.insertRow(rows);	//增加1行
	row.id=rows;
	row.bgColor="#FFF";
	td0=row.insertCell(0);
	td1=row.insertCell(1);
	td2=row.insertCell(2);
	td3=row.insertCell(3);
	td0.height="32px";
	td0.align="center";
	td1.align="center";
	td2.align="center";
	td3.align="center";
	var v=m_name+"#"+c_name+"#"+m_result;
	td0.innerHTML="<label>&nbsp;&nbsp;<input type='checkbox' name='r[]' id='r_'"+rows+" value='"+v+"' checked='checked'>&nbsp;&nbsp;</label>";
	td1.innerHTML=m_name;
	td2.innerHTML=c_name;
	td3.innerHTML=m_result;
}
</script>
<?php 
	session_start();
	include('../db_connect.php');
	$arr_week=array("星期天","星期一","星期二","星期三","星期四","星期五","星期六");
	$w_index=$_POST['w_index'];
	//数据获取
	$w=$_POST['w'];
	$lesson=$_POST['lesson'];
	//识别教师的用户ID
	$sqls_t="select u_id from s_user where u_name='".$_SESSION['uname']."'";
	$rs_t=mysql_query($sqls_t,$conn);
	$arr_t=mysql_fetch_array($rs_t);
	$id_teacher=$arr_t['u_id'];//教师的ID
	mysql_free_result($rs_t);
	//识别该老师的全部任课机房、班级以及当天的任课机房、班级
	$sqls_t_plan="select * from s_class_plan where p_teacher_id=".$id_teacher." and p_xingqi=".$w." and p_node like '%".$lesson."%'";
	$rs_t_plan=mysql_query($sqls_t_plan,$conn);
	if(!$rs_t_plan||mysql_num_rows($rs_t_plan)==0)	//当天该老师没课
	{	echo "<div id='tiqi'>敬爱的".$_SESSION['truename']."老师您好，您今天没有上课任务，不需填写实训室使用情况。";
		echo "如果您需要继续登记，请选择其它的使用日期。<br>";
		echo "<a href='use_date_select.php'>重新选择日期</a></div>";
		exit;
	}
	else
	{
		$arr_t_plan=mysql_fetch_array($rs_t_plan);
?>
<form name="form1" method="post" action="use_data_save.php">
  <table width="100%" height="267" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist">
    <tr>
      <td height="29" colspan="10" bgcolor="#E0E0E0">实训室设备情况登记      </td>
    </tr>
    <tr>
      <td width="9%" height="29" align="center" bgcolor="#FFFFFF">实训室编号</td>
      <td width="11%" align="center" bgcolor="#FFFFFF" class="list"><?php echo $arr_t_plan['p_shi_id'];?>
      <input name="lab_index" type="hidden" id="lab_index" value="<?php echo $arr_t_plan['p_shi_id'];?>" /></td>
      <td width="10%" align="center" bgcolor="#FFFFFF">周次</td>
      <td width="10%" align="center" bgcolor="#FFFFFF" class="list"><?php echo "第".$w_index."周";?><input name="week_index" type="hidden" id="week_index" value="<?php echo $w_index;?>">
      </td>
      <td width="7%" align="center" bgcolor="#FFFFFF">日期</td>
      <td width="12%" align="center" bgcolor="#FFFFFF" class="list">
        <?php echo $arr_week[$arr_t_plan['p_xingqi']];?>
        <input type="hidden" name="xingqi" id="xingqi" value="<?php echo $arr_t_plan['p_xingqi'];?>">
       </td>
      <td width="8%" align="center" bgcolor="#FFFFFF">节次</td>
      <td width="13%" align="center" bgcolor="#FFFFFF" class="list"><?php echo "第".$lesson."节";?><input type="hidden" name="lesson" id="lesson" value="<?php echo $lesson;?>"></td>
      <td width="8%" align="center" bgcolor="#FFFFFF">班级</td>
      <td width="12%" align="center" bgcolor="#FFFFFF" class="list"><?php echo $arr_t_plan['p_class_id'];?>
      <input type="hidden" name="class" id="class" value="<?php echo $arr_t_plan['p_class_id'];?>" /></td>
    </tr>
    <tr>
      <td height="34" align="center" bgcolor="#FFFFFF"><label for="machine"></label>
      <label>上课老师 </label></td>
      <td height="34" colspan="2" align="center" bgcolor="#FFFFFF" class="list"><?php echo $_SESSION['truename'];?></td>
      <td height="34" colspan="2" align="center" bgcolor="#FFFFFF">机器名称
       <select name="machine" class="list" id="machine">
       <option value="全部">全部</option> 
	   <?php //查出该机房全部的机器名称
	   $sqls_machine="select distinct(m_name) from s_machine where m_shi_id='".$arr_t_plan['p_shi_id']."'";
	   $rs_machine=mysql_query($sqls_machine,$conn);
	   if($rs_machine&&mysql_num_rows($rs_machine)>0)
	   {	
	   		for($i=0;$i<mysql_num_rows($rs_machine);$i++){
				$arr_machine=mysql_fetch_array($rs_machine);   
	   ?> 
          <option value="<?php echo $arr_machine['m_name'];?>"><?php echo $arr_machine['m_name'];?></option>
      <?php }
	  mysql_free_result($rs_machine);
	  }
	  else {?>
	  	  <option value="全部">全部</option>      
        <?php } ?></select>
      </td>
      <td height="34" colspan="2" align="center" bgcolor="#FFFFFF">设备部件
        <select name="construct" class="list" id="construct">
        <option value="全部">全部</option>
        <?php //查出全部部件名称
	   $sqls_compone="select distinct(m_bujian) from s_machine where m_shi_id='".$arr_t_plan['p_shi_id']."'";
	   $rs_compone=mysql_query($sqls_compone,$conn);
	   if($rs_compone&&mysql_num_rows($rs_compone)>0)
	   {	
	   		for($i=0;$i<mysql_num_rows($rs_compone);$i++){
				$arr_compone=mysql_fetch_array($rs_compone);   
	   ?> 
        <option value="<?php echo $arr_compone['m_bujian'];?>"><?php echo $arr_compone['m_bujian'];?></option>
      <?php }
	  mysql_free_result($rs_compone);
	  }
	  else {?>
	  	  <option value="全部">全部</option>      
        <?php } ?></select>
      </td>
      <td height="34" colspan="2" align="center" bgcolor="#FFFFFF"><label>运行情况</label>
        <label>　 </label>
        <label>
          <input name="result" type="radio" id="result_0" value="正常" checked="checked" />
        正常</label>
        <label>
          <input type="radio" name="result" value="故障" id="result_1" />
      故障</label></td>
      <td height="34" align="center" bgcolor="#FFFFFF"><input type="button" name="button2" id="button2" value="添加"  onclick="addtolist();"/></td>
    </tr>
    <tr>
      <td height="170" colspan="10" align="center" valign="top" bgcolor="#FFFFFF">
      <table width="100%" height="26" border="0" cellpadding="0" cellspacing="1" id="list">
        <tr>
          <td width="7%" height="24" align="center" bgcolor="#CFCFEF">序号</td>
          <td width="36%" align="center" bgcolor="#CFCFEF">机器名称</td>
          <td width="30%" align="center" bgcolor="#CFCFEF">设备部件</td>
          <td align="center" bgcolor="#CFCFEF">运行情况</td>
          </tr>
      </table> 
      </td>
    </tr>
  </table>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="41" colspan="10" align="center" bgcolor="#F3F3F3"><input type="submit" name="button" id="button" value="保存登记"></td>
    </tr>
  </table>
</form>
<?php 
	mysql_free_result($rs_t_plan);
	}
	?>