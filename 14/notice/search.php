<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>搜索结果</title>
<style type="text/css">
body,td,th {
	font-size: 12px;
}
#t_list {
	background-color: #C7E2F3;
}
a:link {
	font-size: 12px;
	color: #069;
	text-decoration: none;
}
a:visited {
	font-size: 12px;
	color: #06F;
	text-decoration: none;
}
a:hover {
	font-size: 12px;
	color: #900;
	text-decoration: none;
}
a.page:link {
	font-size: 12px;
	color: #FFF;
	background-color: #039;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
	margin-right: 3px;
	margin-left: 3px;
}
a.page:visited {
	font-size: 12px;
	background-color: #009;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
	color: #FFF;
	margin-right: 3px;
	margin-left: 3px;
}
a.page:hover {
	font-size: 12px;
	color: #FF0;
	text-decoration: none;
	background-color: #390;
	margin-right: 3px;
	margin-left: 3px;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
}
.num_css {
	font-size: 12px;
	font-weight: normal;
	color: #900;
	text-decoration: none;
}
</style>
</head>
<?php	require_once("conn.php");?>
<?php
	//获取搜索关键字
	if(!empty($_POST['s_key']))
		{$wkey=$_POST['s_key'];}
	else
	{$wkey=$_GET['s_key'];}
	//获取当前分页码
	if(isset($_GET['page']))
		{$c_page=$_GET['page'];}
	else
		{$c_page=1;}
	//计算总页数
	$sqls="select * from notice_info where title like '%$wkey%'";
	$res=mysql_query($sqls);
	if(!$res)
		{echo "找不到相关的公告";
		 return;
		}
	$res_count=mysql_num_rows($res);//总记录数
	$page_count=ceil($res_count/10);
	//查出当前页的公告，每页10条
	$offset=($c_page-1)*10;	
	$sqls="select * from notice_info where title like '%$wkey%' order by n_time desc limit ".$offset.",10";
	$res=mysql_query($sqls);
?>
<body>
<table width="800" height="60" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="180" height="58" bgcolor="#C7E2F3">校园公告[搜索结果]</td>
    <td width="295" align="right" bgcolor="#C7E2F3"><form id="form1" name="form1" method="post" action="index.php">
      <label for="s_key"></label>
      <input type="text" name="s_key" id="s_key" />
      <input type="submit" name="button" id="button" value="搜索" />
    </form></td>
  </tr>
</table>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="32">共找到与&quot;<span class="num_css"><?php echo $wkey;?></span>&quot;相关的公告<span class="num_css"><?php echo $res_count;?></span>条</td>
  </tr>
</table>
<table width="800" height="69" border="0" align="center" cellpadding="0" cellspacing="1" id="t_list">
  <tr>
    <td width="76" height="31" align="center" bgcolor="#CCCCFF">序号</td>
    <td width="548" align="center" bgcolor="#CCCCFF">公告标题</td>
    <td width="172" align="center" bgcolor="#CCCCFF">发布日期</td>
  </tr>
  <?php
  	$notice=mysql_fetch_array($res);
	$i=0;
	do{	
		$i++;
	?>
  <tr>
    <td height="31" align="center" bgcolor="#FFFFFF"><?php echo $i;?></td>
    <td height="31" bgcolor="#FFFFFF"><a href="notice.php?n_id=<?php echo $notice['id'];?>"><?php echo $notice['title'];?></a></td>
    <td width="172" align="center" bgcolor="#FFFFFF">
    <?php echo $notice['n_time'];?></td>
  </tr>
  <?php
	}
  	while($notice=mysql_fetch_array($res));
  ?>
</table>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" class="page">
  <tr>
    <td width="654" height="37" align="center" class="page" >
<?php
		//分页程序
		if($page_count!=1)
			{echo "<a href=index.php?page=1&s_key=$wkey class=page>首页</a>";}
		for($i=1;$i<=$page_count;$i++)
			{echo "<a href=index.php?page=$i&s_key=$wkey class=page>".$i."</a>";}
		if($page_count!=1)
			{echo "<a href=index.php?page=$page_count&s_key=$wkey class=page>尾页</a>";}
?>
    </td>
    <td width="146" align="center" class="page" ><a href="index.php">返回首页</a></td>
  </tr>
</table>
</body>
</html>