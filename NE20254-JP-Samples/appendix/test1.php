<?php
require_once('PEAR.php');
class Foo {
  function Foo($value) {
    if ($value == 0) {
      $this = new PEAR_Error();
    }
  }
}

$a = new Foo(0); // PHP5では致命的エラー発生
?>
