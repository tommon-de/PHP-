<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>批量文件上传</title>
<script type="text/javascript">
	function add_file()
	{
		var tab=document.getElementById("file_table");	//表格名称
		var num_row=tab.rows.length;	//已有表格的行数
		if(num_row<9){	//最多9行
			var new_row=tab.insertRow();	//表格新插入一行
			var col_1=new_row.insertCell();	//每行两列
			var col_2=new_row.insertCell();
			col_1.height="32";
			col_1.innerHTML="<input type='file' name='f_"+num_row+"' id='f_"+num_row+"' />";
		}
	}
	function des_file()
	{
		var tab=document.getElementById("file_table");	//表格名称
		var num_row=tab.rows.length-1;	//已有表格的最后一行
		if(num_row>0){	//至少保留一行
			tab.deleteRow(num_row);}		
	}
</script>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="471" border="0" cellspacing="0" cellpadding="0" id="file_table">
    <tr>
      <td width="264" height="32"><label for="f"></label>
      <input type="file" name="f_0" id="f_0" /></td>
      <td width="207" align="center"><input type="button" name="button" id="button" value="增加文件数" onclick="add_file()"/> 
      &nbsp;&nbsp;<input type="button" name="des" id="des" value="减少文件数" onclick="des_file()"/></td>
    </tr>
  </table>
  <input type="submit" name="button2" id="button2" value="提交上传" />
</form><br />

<?php
	if(!is_dir("files"))
		mkdir("files");	//创建上传目录
	if(!empty($_FILES))	//批量上传
	{
		$num=count($_FILES);	//上传的文件数
		$num_success=0;	//上传成功的文件数
		for($i=0;$i<$num;$i++)
		{
			$f_ax="f_".$i;	//文件域名
			if($_FILES[$f_ax]['name']!="")
			{
				//以上传文件名的最后一部分作为后缀名
				$arr_tmp=explode(".",$_FILES[$f_ax]['name']);
				$num_tmp=count($arr_tmp)-1;
				$ext_name=".".$arr_tmp[$num_tmp];
				// 文件大小转换MB
				$size=intval($_FILES[$f_ax]['size']/1024/1024);
				if($size>=1)
				{
					echo "第".intval($i+1)."个文件超过限制大小<br>";
					continue;
				}
				else
				{
					$new_name="files\\".time().$i.$ext_name;	//上传后新文件名
					echo "正在上传第".intval($i+1)."个文件……<br>";
					move_uploaded_file($_FILES[$f_ax]['tmp_name'],$new_name);
					if($_FILES[$f_ax]['error']==0)
						$num_success+=1;
				}
			}
		}
		echo "一共".$num_success."个文件上传成功";
	}
?>
</body>
</html>