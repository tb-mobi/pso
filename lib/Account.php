<?php 
class Account extends Tym{
	protected $cardList;
	protected $id;
	protected $balance;
	protected $number;
	protected $product;
	protected $state;
	protected $currency;
	protected $operations=array();
	public function __construct($p,$products=null){
		$pso=$this->object2Array($p);
		
		$this->id=$pso["ID"];
		$this->number=$pso["account_number"];
		$this->state=$pso["state"];
		$this->currency=new Currency(substr($pso["account_number"],5,3));		
		$this->balance=new SimpleBalance($pso["SaldoA"]);
		$this->product=(!is_null($products))?$products->getProductById($pso["product_ID"]):$pso["product_ID"];
		$this->cardList=(!is_null($pso["CardArray"]))?new CardList($pso["CardArray"]):array();
	}
	/*
	{
		"PSOGetPlatfonAccountsInfoResult":[
			{"CardArray":[],"ID":19196,"SaldoA":0.02,"account_number":"40817810000010225727","product_ID":41,"state":"OPEN"}
			,{"CardArray":[],"ID":19197,"SaldoA":0.7,"account_number":"40817840700011125727","product_ID":41,"state":"OPEN"}
			,{"CardArray":[
				{"Embossed_Name":null,"Expired_Mounth":11,"Expired_Year":15,"ID":117922,"Name":null,"PAN":"510173****8479","State":"WRK","is_active":true}
			],"ID":12375,"SaldoA":1208.5,"account_number":"40817810100010125727","product_ID":5,"state":"OPEN"}
		]
	}
	*/
};
?>
