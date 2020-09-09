<?php
class ArtObject{	//类名与文件名一致

	private $obj_name;	//课程名称
	private $teacher_name;	//教师名称
	private $stu_num;	//开班人数
	public $config_num;	//报名人数
	function __construct($obj,$num)
	{
		$this->obj_name=$obj;	//开班课程
		$this->config_num=$num;	//报名人数
		if($this->obj_name=="声乐基础")
		{
			$this->teacher_name="蒋小为";
			$this->stu_num=20;
		}
		elseif($this->obj_name=="二胡初阶")
		{
			$this->teacher_name="阿丁";
			$this->stu_num=30;
		}
		else
		{
			$this->teacher_name="胡老师";
			$this->stu_num=40;
		}
	}
	public function Obj_info()	//课程信息输出方法
	{
		if($this->config_num>=$this->stu_num)
		{
			echo "《".$this->obj_name."》课已报名".$this->config_num."人，";
			echo "正常开班<br>";
			echo "任课老师:".$this->teacher_name."<br>";
		}
		else
		{
			echo "《".$this->obj_name."》课已报名".$this->config_num."人<br>";
			echo "未达到开班人数，课程取消<br>";
		}
		echo "------------------------------<br>";
	}
}
?>