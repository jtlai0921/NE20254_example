<?php
function exception_handler(Exception $e) {
  print "自訂例外 handler : ".$e->getMessage()."\n";
}

class File {
  function __construct($file) {
    if(!file_exists($file)){
      throw new Exception("檔案 $file 不存在", 3);
    }
    // 一般的處理
  }
}

set_exception_handler('exception_handler'); // 登錄例外處理函式

$obj = new File("foo.txt");
?>
