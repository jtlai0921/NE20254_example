<?php
function exception_handler(Exception $e) {
  print "カスタム例外ハンドラ: ".$e->getMessage()."\n";
}

class File {
  function __construct($file) {
    if(!file_exists($file)){
      throw new Exception("ファイル $file が存在しません", 3);
    }
    // 通常の処理
  }
}

set_exception_handler('exception_handler'); // 例外ハンドラを登録

$obj = new File("foo.txt");
?>
