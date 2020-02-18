<?php
require_once("ZIPCode.php");

$server = new SoapServer(dirname(__FILE__)."/ZIPCode.wsdl");
$server->addFunction('getInfoByZIP');
$server->handle();
?>
