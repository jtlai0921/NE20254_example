<?php
class Foo {
  function __toString() {
    return "__toString() 被呼叫了";
  }
}

$obj = new Foo();

print $obj;        // __toString 被呼叫
echo $obj,"\n";    // __toString 被呼叫
echo $obj."\n";    // __toString 沒被呼叫
echo (string)$obj; // __toString 沒被呼叫
echo "類別 $obj";  // __toString 沒被呼叫

?>
