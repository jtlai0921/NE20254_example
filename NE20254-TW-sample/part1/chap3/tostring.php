<?php
class Foo {
  function __toString() {
    return "__toString() �Q�I�s�F";
  }
}

$obj = new Foo();

print $obj;        // __toString �Q�I�s
echo $obj,"\n";    // __toString �Q�I�s
echo $obj."\n";    // __toString �S�Q�I�s
echo (string)$obj; // __toString �S�Q�I�s
echo "���O $obj";  // __toString �S�Q�I�s

?>
