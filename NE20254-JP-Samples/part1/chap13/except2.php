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
      throw new FileException("ファイル $file が存在しません", 3);
    }
    // 通常の処理
  }
}

try {
  $obj = new File("foo.txt");
  print "例外の後の処理\n";
} catch (FileException $e) {
  print "time:{$e->getTime()}\n";
  print $e;
} catch (Exception $e) {
  print "例外発生:{$e->getMessage()}:{$e->getCode()}\n";
}
?>
