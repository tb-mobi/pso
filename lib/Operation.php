<?php 
class Operation extends Tym{
	protected $id;
	protected $description;
	protected $currency;
	protected $amount;
	protected $currencyAccount;
	protected $amountAccount;
	protected $dateFin;
	protected $date;
	protected $state;
	protected $operations=array();
	public function __construct($p,$products=null){
		$pso=$this->object2Array($p);		
		$this->description=$pso["Description"];
		$this->currency=$pso["OperationCurrency"];
		$this->amount=$pso["EqOperSum"];
		$this->currencyAccount=$pso["Currency"];
		$this->amountAccount=$pso["OperSum"];
		$this->state=$pso["TranshStatus"];
		$this->dateFin=Formatter::FormatPSODate($pso["FactOperDate"]);
		$this->date=Formatter::FormatPSODate($pso["OperDate"]);
	}
	/*
	{
		"Currency":"RUB"
		,"DTFlag":true
		,"Description":"Списание с картсчета, EPA, _________________, PYATEROCHKA 2713, 9 STARYY GAY STR, MOSCOW, RU, 26\/08\/2014 21:31"
		,"EqOperSum":94
		,"FactOperDate":"29.08.2014 23:59:59"
		,"FactOperSum":94
		,"Hold_flag":false
		,"IsTransh":false
		,"OperDate":"29.08.2014 00:00:00"
		,"OperSum":94
		,"OperationCurrency":"RUB"
		,"TranshStatus":""
	}
	*/
};
?>
