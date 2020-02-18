<?php
class Foo {
  function methodA() {
    throw new Exception("預設的例外", 2);
  }
}

try {
  $obj = new Foo();
  $obj->methodA();
  print "例外之後的處理\n";
} catch (Exception $e) {
  print "例外發生:{$e->getMessage()}:{$e->getCode()}\n";
  print "檔案:{$e->getFile()}\n";
}
?>
