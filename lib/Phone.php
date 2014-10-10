<?php 
class Phone extends Tym{
	protected $phone;
	public function __construct($p){
		$pso=$this->object2Array($p->PSOGiveMeAPhoneResult);	
		$this->phone=$pso["Message"];
	}
	/*
	{"PSOGiveMeAPhoneResult":{"ErrorCode":null,"Message":"9250423346","is_registered":true}}
	*/
};
?>
