<?php 
class AccountList extends Tym{
	protected $_list;
	public function __construct($p,$products=null){
		$this->_list=array();
		foreach($p->PSOGetPlatfonAccountsInfoResult as $acct)array_push($this->_list,new Account($acct,$products));
	}
	/**/
};
?>