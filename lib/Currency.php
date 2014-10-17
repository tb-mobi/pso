<?php 
class Currency extends Tym{
	protected $value;
	public function __construct($a){
		$this->value=$a;
	}
	public function get(){
		$cur=$this->value;
		$ret=array();
		if(!strcmp($this->value,"840"))$ret=array("code"=>$cur,"dollar"=>true);
		else if($this->value==="978")$ret=array("code"=>$cur,"euro"=>true);
		else $ret=array("code"=>$cur,"ruble"=>true);
		return $ret;
	}
};
?>