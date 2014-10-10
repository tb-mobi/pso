<?php 
class Product extends Tym{
	protected $description;
	protected $id;
	protected $name;
	public function __construct($p){
		$pso=$this->object2Array($p);
		$this->id=$pso["ID"];
		$this->name=$pso["Name"];
		$this->description=urldecode($pso["Description"]);
	}
	/*
	{
		"PSOGetProductsListResult":[
			{"Description":null,"ID":41,"Name":"Расчетный счет"}
			,{"Description":null,"ID":5,"Name":"Обычные карты"}
			,{"Description":null,"ID":6,"Name":"Кредит на карту v1"}
		]
	}
	*/
};
?>
