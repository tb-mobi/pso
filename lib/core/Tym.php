<?php 
class Tym{
	public function __set($n,$v){
		if($this->__isset($n))$this->$n=$v;
		return $this;
	}
	public function __get($n){
		return ($this->__isset($n))?$this->$n:null;
	}
	public function __isset($n){
		return property_exists(get_called_class(),$n);
	}
	public function get(){
		//return $this->object2Array($this);
		$res=array();
		if(property_exists(get_called_class(),"_list")){
			foreach($this->_list as $item){
				array_push($res,$item->get());
			}
			return $res;
		}
		foreach(get_class_vars(get_called_class()) as $p=>$v){
			if(is_object($this->$p)){
				if(class_exists(get_class($this->$p)))$res[$p]=$this->$p->get();//other object of TymLib
			}
			else if(is_array($this->$p)){
				$arr=$this->$p;
				if(isset($arr["year"])&&isset($arr["month"]))
					$res[$p]=$arr["year"].'-'.$arr["mon"].'-'.$arr["mday"].'T'.$arr["hours"].':'.$arr["minutes"].':'.$arr["seconds"].'.99'.date('O');//datetime object
			}
			else $res[$p]=$this->$p;
		}
		return $res;
	}
	public function json(){
		//return json_encode($this->object2Array($this));
		return json_encode($this->get());
	}
	protected function object2Array($d){
		if (is_object($d)) {
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map($this->object2Array, $d);
		}
		else {
			// Return array
			return $d;
		}
	}
};
?>