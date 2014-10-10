<?php 
class ProductList extends Tym{
	protected $_list;
	public function __construct($p){
		$this->_list=array();
		foreach($p->PSOGetProductsListResult as $item)array_push($this->_list,new Product($item));
	}
	public function getProductById($id){
		foreach($this->_list as $product){
			if($product->id==$id)return $product;
		}
		return null;
	}
	/**/
};
?>