<?php
class Foo {
  function methodA() {
    throw new Exception("デフォルトの例外", 2);
  }
}

try {
  $obj = new Foo();
  $obj->methodA();
  print "例外の後の処理\n";
} catch (Exception $e) {
  print "例外発生:{$e->getMessage()}:{$e->getCode()}\n";
  print "ファイル:{$e->getFile()}\n";
}
?>
