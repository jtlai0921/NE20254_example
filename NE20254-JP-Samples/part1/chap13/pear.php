<?php
require_once 'PEAR/Exception.php';

class File {
  function __construct($file) {
    if(!file_exists($file)){
      throw new PEAR_Exception("�ե����� $file ��¸�ߤ��ޤ���", 3);
    }
    // �̾�ν���
  }
}

function LogObserver(PEAR_Exception $e) {
  print "LogObserver:".$e->getMessage()."\n";
}

PEAR_Exception::addObserver('LogObserver');

try {
  $obj = new File("foo.txt");
  print "�㳰�θ�ν���\n";
} catch (PEAR_Exception $e) {
  print $e;
}
?>
