<?php
require_once('PEAR.php');
class Foo {
  function Foo($value) {
    if ($value == 0) {
      $this = new PEAR_Error();
    }
  }
}

$a = new Foo(0); // PHP5$B$G$OCWL?E*%(%i!<H/@8(B
?>
