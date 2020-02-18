<?php
class FileException extends Exception
{
  protected $time;

  function __construct($msg, $code) {
    $this->time = time();
    parent::__construct($msg, $code);
  }

  function __toString() {
    return __CLASS__ . ":{$this->message}:{$this->code}";
  }

  function getTime() {
    return $this->time;
  }
}

class File {
  function __construct($file) {
    if(!file_exists($file)){
      throw new FileException("檔案 $file 不存在", 3);
    }
    // 一般的處理
  }
}

try {
  $obj = new File("foo.txt");
  print "例外之後的處理\\n";
} catch (FileException $e) {
  print "time:{$e->getTime()}\n";
  print $e;
} catch (Exception $e) {
  print "例外發生:{$e->getMessage()}:{$e->getCode()}\n";
}
?>
