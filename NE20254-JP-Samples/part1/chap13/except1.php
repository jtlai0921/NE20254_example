<?php
class Foo {
  function methodA() {
    throw new Exception("�ǥե���Ȥ��㳰", 2);
  }
}

try {
  $obj = new Foo();
  $obj->methodA();
  print "�㳰�θ�ν���\n";
} catch (Exception $e) {
  print "�㳰ȯ��:{$e->getMessage()}:{$e->getCode()}\n";
  print "�ե�����:{$e->getFile()}\n";
}
?>
