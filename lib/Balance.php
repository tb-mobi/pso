<?php 
class Balance extends Tym{
	protected $avaliable;	
	protected $ledger;	
	protected $overdraft;
	protected $percent;
	protected $hold;
	protected $currency;
	public function get(){
		return array(
			"currency"=>$this->currency
			,"avaliable"=>$this->avaliable
			,"ledger"=>$this->ledger
			,"percent"=>$this->percent
			,"overdraft"=>$this->overdraft
			,"hold"=>$this->hold
		);
	}
};
?>