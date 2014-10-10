<?php 
class Login extends Tym{
	protected $fullName;
	protected $sessionId;
	public function __construct($p){
		$pso=$this->object2Array($p->PSOCabinAuthResult);	
		$this->sessionId=$pso["temp_id"];
		$this->fullName=$pso["StringField"];
	}
	/*
	{
		"PSOCabinAuthResult":{
			"CardsArray":null
			,"Count":0
			,"CredInfo":null
			,"ErrorFlag":false
			,"Good_password":true
			,"Need_PAN":false
			,"Statement_of_Account":null
			,"StringArray":null
			,"StringField":"Лифшиц Илья Александрович"
			,"temp_id":"a9091836-edaf-4965-a273-96df07d38d95"
		}
	}
	{"PSOGetPlatfonAccountsInfoResult":[{"CardArray":[],"ID":19196,"SaldoA":0.02,"account_number":"40817810000010225727","product_ID":41,"state":"OPEN"},{"CardArray":[],"ID":19197,"SaldoA":0.7,"account_number":"40817840700011125727","product_ID":41,"state":"OPEN"},
		{
			"CardArray":[{"Embossed_Name":null,"Expired_Mounth":11,"Expired_Year":15,"ID":117922,"Name":null,"PAN":"510173****8479","State":"WRK","is_active":true}]
		,"ID":12375,"SaldoA":1208.5,"account_number":"40817810100010125727","product_ID":5,"state":"OPEN"}]}
	*/
};
?>
