<?php
class Foo {
  function __toString() {
    return "__toString()、ャ・ウ。シ・�Ε�、�Α�、キ、ソ\n";
  }
}

$obj = new Foo();

print $obj;        // __toString、ャ・ウ。シ・�Ε�、���
echo $obj,"\n";    // __toString、ャ・ウ。シ・�Ε�、���
echo $obj."\n";    // __toString、マ・ウ。シ・�Ε�、�Ε蓮◆�
echo (string)$obj; // __toString、マ・ウ。シ・�Ε�、�Ε蓮◆�
echo "・ッ・鬣ケ $obj"; // __toString、マ・ウ。シ・�Ε�、�Ε蓮◆�
?>
