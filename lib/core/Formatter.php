<?php
class Formatter{
	public static function ToAmount($val){
		$val=preg_replace("/[,\s]/m",".",$val);
		return number_format($val, 2, '.', ' ');
	}
	public static function FormatPSODate($str){
		if(preg_match("/^(\d{2})\.(\d{2})\.(\d{4})\s(\d{2})\:(\d{2})\:(\d{2})$/",$str,$m)){
			return getdate(mktime($m[4],$m[5],$m[6],$m[2], $m[1],$m[3]));
		}
		return null;
	}
	public static function FormatExpireDate($str){
		if(preg_match("/^(\d{2})\/(\d{2})$/",$str,$m)){
			$mon=(int)$m[1]+1;
			$mon=($mon>12)?1:$mon;
			return getdate(mktime(23,59,59,$mon,0,2000+(int)$m[2]));
		}
		return null;
	}
	public static function FormatPSOExpireDate($m,$y){
		$mon=(int)$m+1;
		$mon=($mon>12)?1:$mon;
		return getdate(mktime(23,59,59,$mon,0,2000+(int)$y));
	}
	public static function ToJson($val){
		return json_encode(Formatter::object2Array($val));
	}
	public static function object2Array($d){
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
			return array_map(Formatter::object2Array, $d);
		}
		else {
			// Return array
			return $d;
		}
	}
};
?>