<?php
class TymParser{
	protected $products;
	protected $_object=null;
	protected $_string="";
	public function parse($str){
		$this->_string=$str;
		$obj=json_decode($str);
		foreach(get_object_vars($obj) as $r=>$d){
			if(isset($this->knownPSOResponse[$r])){
				$class=$this->knownPSOResponse[$r]["class"];
				if("notImplemented"!==$class){
					if(isset($this->knownPSOResponse[$r]["property"])&&isset($this->knownPSOResponse[$r]["property"]["params"])){
						$property=$this->knownPSOResponse[$r]["property"]["params"][0];
						$this->_object=new $class($obj,(isset($this->$property)&&!is_null($this->$property))?$this->$property:null);
					}
					else $this->_object=new $class($obj);
					if(isset($this->knownPSOResponse[$r]["property"])&&isset($this->knownPSOResponse[$r]["property"]["save2local"])){
						$property=$this->knownPSOResponse[$r]["property"]["save2local"];
						$this->$property=$this->_object;
					}
				}
			}
		}
	}
	public function __toString(){
		return is_null($this->_object)?$this->_string:$this->_object->json();
	}
	public function service(){
		$req=parse_url($_SERVER["REQUEST_URI"]);
		$INTERNAL_REQUEST_PARAMS=array("url","session","request");
		$USE_PROXY=true;
		$PSO_SERIVCE_URL="http://pso_test.2tbank.ru/PSO.svc/json/";
		$CONTEXT_OPTIONS = array('http' => array(
			'header'  => "Content-type: application/json"
			,'method'  => 'POST'
		));
		if($USE_PROXY){
			$CONTEXT_OPTIONS['http']['proxy']='tcp://10.0.1.46:8080';
			$CONTEXT_OPTIONS['http']['request_fulluri']=true;
		}
		if(preg_match_all("/(.+?)\//im",$req["path"],$m)){
			$request=$this->knownPSORequest[$m[1][count($m[1])-1]];
			$data = array();
			foreach($_REQUEST as $param=>$value){
				if(!in_array($param,$INTERNAL_REQUEST_PARAMS)){
					$psoParamName=isset($request["pso"]["params"][$param])?$request["pso"]["params"][$param]:$param;
					$data[$psoParamName]=$value;
				}
			}
			$CONTEXT_OPTIONS['http']['content']=json_encode($data);
			$url=PSO_SERIVCE_URL.$request["pso"]["request"]."/";
			$context=stream_context_create($CONTEXT_OPTIONS);
			try{
				print_r($CONTEXT_OPTIONS);
				$_result=file_get_contents($url,false,$context);
			}
			catch(Exception $e){
				$_result='{"exception":{"code":1,"message":"Error"}}';
			}
			$this->parse($_result);

		}
	}
	protected $knownPSOResponse=array(
		"PSOGetProductsListResult"=>array("class"=>"ProductList","property"=>array("save2local"=>"products"))
		,"PSOGetPlatfonAccountsInfoResult"=>array("class"=>"AccountList","property"=>array("params"=>array("products")))
		,"PSOCabinAuthResult"=>array("class"=>"Login")
		,"PSOGiveMeAPhoneResult"=>array("class"=>"Phone")
		,"PSOCabinGetOpersPeriod2Result"=>array("class"=>"OperationList")
		,"PSOCabinGetCardsListResult"=>array("class"=>"notImplemented")
		,"GetBankInfoFromBIK"=>array("class"=>"notImplemented")
		,"PSOCabinIdentResult"=>array("class"=>"notImplemented")
		,"PSOCabinGetOpersPagesResult"=>array("class"=>"notImplemented")
		,"PSOCabinGetLastOpersResult"=>array("class"=>"notImplemented")
		,"PSOCabinGetOpersPeriodResult"=>array("class"=>"notImplemented")
		,"PSOSetPasswordCompromitedResult"=>array("class"=>"notImplemented")
		,"PSOSetLoginResult"=>array("class"=>"notImplemented")
		,"PSOSetClientStatusToIdentResult"=>array("class"=>"notImplemented")
		,"PSOGetAccountServicesResult"=>array("class"=>"notImplemented")
		,"PSOSetAccountServiceResult"=>array("class"=>"notImplemented")
		,"PSOGetClientProductsResult"=>array("class"=>"notImplemented")
		,"PSOShowCreditRqHistoryResult"=>array("class"=>"notImplemented")
		,"PSOGetClientCredProductsResult"=>array("class"=>"notImplemented")
		,"PSOGetPromisedPayDataResult"=>array("class"=>"notImplemented")
		,"PSONewRequestionResult"=>array("class"=>"notImplemented")
		,"PSONewRequestionResult"=>array("class"=>"notImplemented")
		,"PSONewRequestionResult"=>array("class"=>"notImplemented")
		,"PSOSendTemporaryPasswordResult"=>array("class"=>"notImplemented")
		,"PSOValidateTemporaryPasswordResult"=>array("class"=>"notImplemented")
		,"PSONewRequestionResult"=>array("class"=>"notImplemented")
		,"PSOGetFullCredSumResult"=>array("class"=>"notImplemented")
		,"PSONewRequestionResult"=>array("class"=>"notImplemented")
	);
	protected $knownPSORequest=array(
		"products"=>array(
			"pso"=>array(
				"request"=>"PSOGetProductsList"
				,"params"=>array()
			)
		)
		,"accounts"=>array(
			"pso"=>array(
				"request"=>"PSOGetPlatfonAccountsInfo"
				,"params"=>array("sessionid"=>"temp_id")
			)
		)
		,"signin"=>array(
			"pso"=>array(
				"request"=>"PSOCabinAuth"
				,"params"=>array("user"=>"login","password"=>"pass")
			)
		)
		,"phone"=>array(
			"pso"=>array(
				"request"=>"PSOGiveMeAPhone"
				,"params"=>array("sessionid"=>"temp_id")
			)
		)
		,"operations"=>array(
			"pso"=>array(
				"request"=>"PSOCabinGetOpersPeriod2"
				,"params"=>array("sessionid"=>"temp_id","account"=>"acc_id")
			)
		)
		,"PSOGiveMeAPhoneResult"=>array("class"=>"Phone")
		,"PSOCabinGetOpersPeriod2Result"=>array("class"=>"OperationList")
		,"PSOCabinGetCardsListResult"=>array("class"=>"notImplemented")
		,"GetBankInfoFromBIK"=>array("class"=>"notImplemented")
		,"PSOCabinIdentResult"=>array("class"=>"notImplemented")
		,"PSOCabinGetOpersPagesResult"=>array("class"=>"notImplemented")
		,"PSOCabinGetLastOpersResult"=>array("class"=>"notImplemented")
		,"PSOCabinGetOpersPeriodResult"=>array("class"=>"notImplemented")
		,"PSOSetPasswordCompromitedResult"=>array("class"=>"notImplemented")
		,"PSOSetLoginResult"=>array("class"=>"notImplemented")
		,"PSOSetClientStatusToIdentResult"=>array("class"=>"notImplemented")
		,"PSOGetAccountServicesResult"=>array("class"=>"notImplemented")
		,"PSOSetAccountServiceResult"=>array("class"=>"notImplemented")
		,"PSOGetClientProductsResult"=>array("class"=>"notImplemented")
		,"PSOShowCreditRqHistoryResult"=>array("class"=>"notImplemented")
		,"PSOGetClientCredProductsResult"=>array("class"=>"notImplemented")
		,"PSOGetPromisedPayDataResult"=>array("class"=>"notImplemented")
		,"PSONewRequestionResult"=>array("class"=>"notImplemented")
		,"PSONewRequestionResult"=>array("class"=>"notImplemented")
		,"PSONewRequestionResult"=>array("class"=>"notImplemented")
		,"PSOSendTemporaryPasswordResult"=>array("class"=>"notImplemented")
		,"PSOValidateTemporaryPasswordResult"=>array("class"=>"notImplemented")
		,"PSONewRequestionResult"=>array("class"=>"notImplemented")
		,"PSOGetFullCredSumResult"=>array("class"=>"notImplemented")
		,"PSONewRequestionResult"=>array("class"=>"notImplemented")
	);
};
?>