<?php
function __autoload($class) {
  require_once($class.".php");
}
$obj = new MyCart("ËÜ²°");
?>
