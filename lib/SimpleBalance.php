<?php 
class SimpleBalance extends Balance{
	protected $_avaliable;	
	public function __construct($a){
		$this->avaliable=(double)$a;
		$this->ledger=(double)$a;
		$this->currency="RUB";
	}
};
?>