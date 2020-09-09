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
	var rs=list.rows.length;
	var r=list.insertRow(rs);	//增加1行
	r.id=rs;
	r.bgColor="#FFF";
	td0=r.insertCell(0);
	td1=r.insertCell(1);
	td2=r.insertCell(2);
	td3=r.insertCell(3);
	td0.height="32px";
	td0.align="center";
	td1.align="center";
	td2.align="center";
	td3.align="center";
	var v=m_name+"#"+c_name+"#"+m_result;
	td0.innerHTML="<label>&nbsp;&nbsp;<input type='checkbox' name='r[]' id='r_'"+rs+" value="+v+" checked='checked'>"+rs+"</label>";
	td1.innerHTML=m_name;
	td2.innerHTML=c_name;
	td3.innerHTML=m_result;
}
</script>
<?php 
	session_start();
	include('../db_connect.php');
	//自动识别今天是星期几以及当前的时间
	$w_today=date("w",time());
	switch($w_today)
	{
		case 0:
		$w="星期天";
		break;
		case 1:
		$w="星期一";
		break;
		case 2:
		$w="星期二";
		break;
		case 3:
		$w="星期三";
		break;
		case 4:
		$w="星期四";
		break;
		case 5:
		$w="星期五";
		break;
		case 6:
		$w="星期六";
		break;
	}
	//识别教师的用户ID
	$sqls_t="select u_id from s_user where u_name='".$_SESSION['uname']."'";
	$rs_t=mysql_query($sqls_t,$conn);
	$arr_t=mysql_fetch_array($rs_t);
	$id_teacher=$arr_t['u_id'];//教师的ID
	mysql_free_result($rs_t);
	//识别该老师的全部任课机房、班级以及当天的任课机房、班级
	//根据当前小时，决定是第几节课,10:45前，认定为12节，14:30以前
	//认定为34节，16：30以前，认定为56节，18:00以前，认定为78节
	$houre=date("H",time());
	$minus=date("i",time());
	$sqls_lab_now="select * from s_class_plan where p_teacher_id=".$id_teacher." and
	 p_xingqi=".$w_today;
	 
?>
<form name="form1" method="post" action="use_data_save.php">
  <table width="100%" height="273" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist">
    <tr>
      <td height="35" colspan="10" bgcolor="#E0E0E0">实训室设备情况登记</td>
    </tr>
    <tr>
      <td width="9%" height="29" align="center" bgcolor="#FFFFFF">实训室编号</td>
      <td width="11%" align="center" bgcolor="#FFFFFF"><label for="lab_id"></label></td>
      <td width="10%" align="center" bgcolor="#FFFFFF">周次</td>
      <td width="10%" align="center" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="7%" align="center" bgcolor="#FFFFFF">日期</td>
      <td width="12%" align="center" bgcolor="#FFFFFF"><?php echo $w;?></td>
      <td width="8%" align="center" bgcolor="#FFFFFF">节次</td>
      <td width="13%" align="center" bgcolor="#FFFFFF"><select name="lesson" id="lesson">
        <option value="12">第1、2节</option>
        <option value="34">第3、4节</option>
        <option value="56">第5、6节</option>
        <option value="78">第7、8节</option>
      </select></td>
      <td width="8%" align="center" bgcolor="#FFFFFF">班级</td>
      <td width="12%" align="center" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr>
      <td height="34" align="center" bgcolor="#FFFFFF"><label for="machine"></label>
      <label>上课老师 </label></td>
      <td height="34" colspan="2" align="center" bgcolor="#FFFFFF"><?php echo $_SESSION['truename'];?></td>
      <td height="34" colspan="2" align="center" bgcolor="#FFFFFF">机器名称 
        <select name="machine" id="machine">
          <option value="pc01">pc01</option>
          <option value="pc02">pc02</option>
      </select></td>
      <td height="34" colspan="2" align="center" bgcolor="#FFFFFF">设备部件
        <label for="construct"></label>
      <label></label>      <select name="construct" id="construct">
        <option value="鼠标">鼠标</option>
        <option value="键盘">键盘</option>
        <option value="显示器">显示器</option>
        <option value="主机">主机</option>
      </select></td>
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
      <td height="170" colspan="10" align="center" valign="top" bgcolor="#FFFFFF"><table width="100%" height="26" border="0" cellpadding="0" cellspacing="1" id="list">
        <tr>
          <td width="7%" height="24" align="center" bgcolor="#CFCFEF">选择</td>
          <td width="36%" align="center" bgcolor="#CFCFEF">机器名称</td>
          <td width="30%" align="center" bgcolor="#CFCFEF">设备部件</td>
          <td align="center" bgcolor="#CFCFEF">运行情况</td>
          </tr>
      </table>        <label for="r_list"></label></td>
    </tr>
    </table>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="41" colspan="10" align="center" bgcolor="#F3F3F3"><input type="submit" name="button" id="button" value="保存登记"></td>
    </tr>
  </table>
</form>
