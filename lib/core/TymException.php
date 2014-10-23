<?php
class TymException extends Tym{
	protected $code;
	protected $category;
	protected $message;
	protected $todo;
	public function __construct($c,$m,$t){
		$this->category="php";
		$this->code=$c;
		$this->message=$m;
		$this->todo=$t;
	}
};
?>