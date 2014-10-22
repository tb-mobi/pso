<?php 
class Card extends Tym{
	protected $embossedName;
	protected $expiredDate;
	protected $id;
	protected $name;
	protected $pan;
	protected $state;
	protected $active;
	public function __construct($p){
		$pso=$this->object2Array($p);
		$this->id=isset($pso["ID"])?$pso["ID"]:(isset($pso["id"])?$pso["id"]:null);
		$this->name=isset($pso["Name"])?$pso["Name"]:null;
		$this->state=isset($pso["State"])?$pso["State"]:(isset($pso["state"])?$pso["state"]:null);
		$this->active=isset($pso["is_active"])?$pso["is_active"]:null;
		$this->pan=isset($pso["PAN"])?$pso["PAN"]:(isset($pso["PAN_TAIL"])?$pso["PAN_TAIL"]:null);
		$this->embossedName=isset($pso["Embossed_Name"])?$pso["Embossed_Name"]:null;
		if(isset($pso["Expired_Mounth"]))$this->expiredDate=Formatter::FormatPSOExpireDate($pso["Expired_Mounth"],$pso["Expired_Year"]);
		else if(isset($pso["exp"]))$this->expiredDate=Formatter::FormatExpireDate($pso["exp"]);
		
	}
	/*
	{"PSOGetPlatfonAccountsInfoResult":[{"CardArray":[],"ID":19196,"SaldoA":0.02,"account_number":"40817810000010225727","product_ID":41,"state":"OPEN"},{"CardArray":[],"ID":19197,"SaldoA":0.7,"account_number":"40817840700011125727","product_ID":41,"state":"OPEN"},
		{
			"CardArray":[{"Embossed_Name":null,"Expired_Mounth":11,"Expired_Year":15,"ID":117922,"Name":null,"PAN":"510173****8479","State":"WRK","is_active":true}]
		,"ID":12375,"SaldoA":1208.5,"account_number":"40817810100010125727","product_ID":5,"state":"OPEN"}]}
	*/
};
?>
