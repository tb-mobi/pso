<?php 
ob_start();
include("../config.php");
include(TYM_PATH."TymLib.php");
$controller=new TymParser;
$controller->service();
file_put_contents("../out.log",ob_get_clean()."\n",FILE_APPEND);
echo $controller;
?>