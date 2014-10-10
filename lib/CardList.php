<?php 
class CardList extends Tym{
	protected $_list;
	public function __construct($p){
		$this->_list=array();
		foreach($p as $item)array_push($this->_list,new Card($item));
	}
	/**/
};
?>