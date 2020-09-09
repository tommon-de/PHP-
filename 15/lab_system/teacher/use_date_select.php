<link href="../css.css" rel="stylesheet" type="text/css" />
<?php 
	$w_int=date("w",time());
	$w_cn=array("星期天","星期一","星期二","星期三","星期四","星期五","星期六");
?>
<form name="form1" method="post" action="use_data_input_later.php">
  <table width="500%" height="37" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist">
    <tr>
      <td height="35" colspan="6" bgcolor="#E0E0E0">实训室设备情况登记》选择使用日期</td>
    </tr>
  </table>
  <table width="500" height="116" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist">
    <tr>
      <td width="63" height="42" align="center" bgcolor="#FFFFFF">周次</td>
      <td width="104" colspan="-1" align="center" bgcolor="#FFFFFF"><label for="w_index"></label>
        <select name="w_index" class="list" id="w_index">
          <option value="1" selected="selected">第1周</option>
          <option value="2">第2周</option>
          <option value="3">第3周</option>
          <option value="4">第4周</option>
          <option value="5">第5周</option>
          <option value="6">第6周</option>
          <option value="7">第7周</option>
          <option value="8">第8周</option>
          <option value="9">第9周</option>
          <option value="10">第10周</option>
          <option value="11">第11周</option>
          <option value="12">第12周</option>
          <option value="13">第13周</option>
          <option value="14">第14周</option>
          <option value="15">第15周</option>
          <option value="16">第16周</option>
          <option value="17">第17周</option>
          <option value="18">第18周</option>
          <option value="19">第19周</option>
          <option value="20">第20周</option>
        </select></td>
      <td width="41" colspan="-1" align="center" bgcolor="#FFFFFF">日期</td>
      <td width="111" colspan="-1" align="center" bgcolor="#FFFFFF"><label for="w"></label>
        <select name="w" class="list" id="w">
          <?php 
		$key=0;
		foreach($w_cn as $v)
		{
			if($w_int==$key){?>
          <option value=<?php echo $key;?> selected="selected"><?php echo $v;?></option>
          <?php }	else{?>
          <option value=<?php echo $key;?>><?php echo $v;?></option>
          <?php }        
			$key+=1;
		}?>
        </select></td>
      <td width="41" colspan="-1" align="center" bgcolor="#FFFFFF">节次</td>
      <td align="center" bgcolor="#FFFFFF"><select name="lesson" class="list" id="lesson">
        <option value="12">第1、2节</option>
        <option value="34">第3、4节</option>
        <option value="56">第5、6节</option>
        <option value="78">第7、8节</option>
</select></td>
    </tr>
    <tr>
      <td height="35" colspan="6" align="center" valign="middle" bgcolor="#FFFFFF"><input name="botton" type="submit" class="button_style" id="botton" value="确定"></td>
    </tr>
  </table>
</form>
