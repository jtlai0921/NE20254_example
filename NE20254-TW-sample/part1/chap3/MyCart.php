<?php
class MyCart {
  protected $item = array();
  public $name;
  // �غc�l
  function __construct($name) {
    $this->name = $name;
    print "�w����{! �w��Ө�{$name}\n";
  }
  // �l�[���~���ʪ���
  function addItem($name, $num) {
    if(isset($this->item[$name])) {
      $this->item[$name] += $num;
    } else {
      $this->item[$name] = $num;
    }
  }
  // ����ʪ����������~
  function show() {
    foreach($this->item as $name=>$value) {
      print "$name:$value\n";
    }
  }
  // �Ѻc�l
  function __destruct() {
    print "����!\n";
  }
}
?>
