<?php
require_once 'PEAR/Exception.php';

class File {
  function __construct($file) {
    if(!file_exists($file)){
      throw new PEAR_Exception("檔案 $file 不存在", 3);
    }
    // 一般的處理
  }
}

function LogObserver(PEAR_Exception $e) {
  print "LogObserver:".$e->getMessage()."\n";
}

PEAR_Exception::addObserver('LogObserver');

try {
  $obj = new File("foo.txt");
  print "例外之後的處理\n";
} catch (PEAR_Exception $e) {
  print $e;
}
?>
