<?php
require_once 'PEAR/Exception.php';

class File {
  function __construct($file) {
    if(!file_exists($file)){
      throw new PEAR_Exception("ファイル $file が存在しません", 3);
    }
    // 通常の処理
  }
}

function LogObserver(PEAR_Exception $e) {
  print "LogObserver:".$e->getMessage()."\n";
}

PEAR_Exception::addObserver('LogObserver');

try {
  $obj = new File("foo.txt");
  print "例外の後の処理\n";
} catch (PEAR_Exception $e) {
  print $e;
}
?>
