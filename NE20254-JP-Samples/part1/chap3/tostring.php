<?php
class Foo {
  function __toString() {
    return "__toString()���㡦��������������������������\n";
  }
}

$obj = new Foo();

print $obj;        // __toString���㡦�����������������
echo $obj,"\n";    // __toString���㡦�����������������
echo $obj."\n";    // __toString���ޡ������������������ϡ���
echo (string)$obj; // __toString���ޡ������������������ϡ���
echo "���á�򧥱 $obj"; // __toString���ޡ������������������ϡ���
?>
