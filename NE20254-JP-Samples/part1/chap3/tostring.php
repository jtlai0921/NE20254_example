<?php
class Foo {
  function __toString() {
    return "__toString()¡¢¥ã¡¦¥¦¡£¥·¡¦ö¦¥ª¡¢ø¦¡«¡¢¥­¡¢¥½\n";
  }
}

$obj = new Foo();

print $obj;        // __toString¡¢¥ã¡¦¥¦¡£¥·¡¦ö¦¥ª¡¢ø¦ë
echo $obj,"\n";    // __toString¡¢¥ã¡¦¥¦¡£¥·¡¦ö¦¥ª¡¢ø¦ë
echo $obj."\n";    // __toString¡¢¥Þ¡¦¥¦¡£¥·¡¦ö¦¥ª¡¢ø¦¥Ï¡¢¡¢
echo (string)$obj; // __toString¡¢¥Þ¡¦¥¦¡£¥·¡¦ö¦¥ª¡¢ø¦¥Ï¡¢¡¢
echo "¡¦¥Ã¡¦ò§¥± $obj"; // __toString¡¢¥Þ¡¦¥¦¡£¥·¡¦ö¦¥ª¡¢ø¦¥Ï¡¢¡¢
?>
