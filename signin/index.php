<?php 
ob_start();
include("../config.php");
include(TYM_PATH."TymLib.php");
$controller=new TymParser;
$controller->service();
$log=ob_get_clean();
Formatter::log($log);
echo $controller;
?>