<?php
function exception_handler(Exception $e) {
  print "���������㳰�ϥ�ɥ�: ".$e->getMessage()."\n";
}

class File {
  function __construct($file) {
    if(!file_exists($file)){
      throw new Exception("�ե����� $file ��¸�ߤ��ޤ���", 3);
    }
    // �̾�ν���
  }
}

set_exception_handler('exception_handler'); // �㳰�ϥ�ɥ����Ͽ

$obj = new File("foo.txt");
?>
