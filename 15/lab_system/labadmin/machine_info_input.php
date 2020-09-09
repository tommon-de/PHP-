<link href="../css.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#form1 #tinfo {
	font-size: 14px;
	color: #036;
	text-decoration: none;
	border: 1px solid #CCC;
}
</style>
<script language="javascript">
function addtolist()	//将本机房的课程安排添加到列表再提交
{
	var d_lab=document.getElementById("lab").value;//机房
	var d_machine=document.getElementById("machine").value;//机器名称与编号
	d_machine=d_machine+"-"+document.getElementById("code_index").value;
	var d_compone=document.getElementById("compone").value;//配件名称
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
	var v=d_lab+"#"+d_machine+"#"+d_compone;
	td0.innerHTML="<label>&nbsp;&nbsp;<input type='checkbox' name='r[]' id='r_'"+rows+" value='"+v+"' checked='checked'>&nbsp;&nbsp;</label>";
	td1.innerHTML=d_lab;
	td2.innerHTML=d_machine;
	td3.innerHTML=d_compone;
}
</script>
<?php
	session_start();
	//查出实训室管理员账号信息
	include("../db_connect.php");
	mysql_query("SET NAMES 'UTF8'");
	$sqls_u_id="select u_id from s_user where u_name='".$_SESSION['uname']."'";
	$rs_u_id=mysql_query($sqls_u_id,$conn);
	$arr_uid=mysql_fetch_array($rs_u_id);
	$uid=$arr_uid[0];	//管理员的ID号
	$mylabs=array();	//实训室编号
	$mycompone=array();//机器编号
	//数据准备查询类
	class Data_PreReady{
		private $db_table;//数据表
		private $get_field;//查询字段
		private $key_field;//查询字段
		private $key_value;//查询字段值
		private $key_type;//查询值类型,0为数值型，1为字符型,2为无条件查询
		private $db_connect;//数据连接
		public $result=array();
		function __construct($db,$tb,$gfield,$kfield,$kvalue,$ktype)	//构造函数
		{
			$this->db_connect=$db;
			$this->db_table=$tb;
			$this->get_field=$gfield;
			$this->key_field=$kfield;
			$this->key_value=$kvalue;
			$this->key_type=$ktype;
			$this->result=$this->Select_data();//返回查询结果
		}
		private function Select_data()//查询函数
		{
			$data_arr=array();
			if($this->key_type==0)
				$sqls_str="select distinct(".$this->get_field.") from ".$this->db_table." where ".$this->key_field."=".$this->key_value;
			elseif($this->key_type==1)
				$sqls_str="select distinct(".$this->get_field.") from ".$this->db_table." where ".$this->key_field."='".$this->key_value."'";
			elseif($this->key_type==2)
				$sqls_str="select distinct(".$this->get_field.") from ".$this->db_table;
			$rs=mysql_query($sqls_str,$this->db_connect);
			if($rs&&mysql_num_rows($rs)>0)
			{
				for($i=0;$i<mysql_num_rows($rs);$i++)
				{
					$tmp_arr=mysql_fetch_array($rs);
					$data_arr[$i]=$tmp_arr[0];
				}
				mysql_free_result($rs);
			}
			return $data_arr;// 返回数据结果数组
		}
	}
	//查出该管理员所负责的全部机房
	$lab=new Data_PreReady($conn,"s_shixunshi","s_shi_index","s_shi_admin",$uid,0);
	$mylabs=$lab->result;
	//查出所有的机器编号
	$bj=new Data_PreReady($conn,"s_shixunshi","s_shi_machine_name","s_shi_admin",$uid,1);
	$mycompone=$bj->result;
?>
<form id="form1" name="form1" method="post" action="machine_info_save.php">
  <table width="100%" height="203" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist">
    <tr>
      <td height="36" colspan="4" bgcolor="#CCCCCC"> 实训室管理》实训室设备资料录入</td>
    </tr>
    <tr>
      <td height="39" align="center" bgcolor="#FFFFFF">实训室
        <label for="lab"></label>
      <?php if(count($mylabs)==0)
	  		echo "请联系实训中心给您安排实训室";
			else{?>
        <select name="lab" class="list" id="lab">
          <?php foreach($mylabs as $v){?>
          <option value="<?php echo $v;?>"><?php echo $v;?></option>
          <?php }?>
        </select>
      <?php }?>      </td>
      <td align="center" bgcolor="#FFFFFF">机器名称
        <?php if(count($mycompone)==0)
	  		echo "请等待实训中心分配机器名称";
			else{?>
        <select name="machine" class="list" id="machine">
          <?php foreach($mycompone as $v){?>
          <option value="<?php echo $v;?>"><?php echo $v;?></option>
          <?php }?>
        </select>
      <?php }?>编号
      <label for="code_index"></label>
      <input name="code_index" type="text" class="list" id="code_index" /></td>
      <td align="center" bgcolor="#FFFFFF">配件名称
        <label for="compone"></label>
      <input type="text" name="compone" id="compone"></td>
      <td width="133" align="center" bgcolor="#FFFFFF"><input type="button" name="button2" id="button2" value="添加"  onClick="addtolist();"/></td>
    </tr>
    <tr>
      <td height="83" colspan="4" align="center" valign="top" bgcolor="#FFFFFF">
      <table width="100%" height="29" border="0" cellpadding="0" cellspacing="1" id="list">
        <tr>
          <td width="9%" height="24" align="center" bgcolor="#CFCFEF">选择</td>
          <td width="14%" align="center" bgcolor="#CFCFEF">实训室</td>
          <td width="37%" align="center" bgcolor="#CFCFEF">机器编号</td>
          <td width="40%" align="center" bgcolor="#CFCFEF">配件名称</td>
          </tr>
      </table> 
      </td>
    </tr>
    <tr>
      <td height="40" colspan="4" align="center" bgcolor="#CCCCCC"><input name="button" type="submit" class="button_style" id="button" value="保存课程安排" />
        　　 
          <input name="import" type="button" class="button_style" id="import" value="导入课程安排" /></td>
    </tr>
  </table>
</form>
