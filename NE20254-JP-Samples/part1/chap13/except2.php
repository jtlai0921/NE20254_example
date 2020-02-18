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
      throw new FileException("�ե����� $file ��¸�ߤ��ޤ���", 3);
    }
    // �̾�ν���
  }
}

try {
  $obj = new File("foo.txt");
  print "�㳰�θ�ν���\n";
} catch (FileException $e) {
  print "time:{$e->getTime()}\n";
  print $e;
} catch (Exception $e) {
  print "�㳰ȯ��:{$e->getMessage()}:{$e->getCode()}\n";
}
?>
