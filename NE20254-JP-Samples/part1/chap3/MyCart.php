<?php
class MyCart {
  protected $item = array();
  public $name;
  // ���󥹥ȥ饯��
  function __construct($name) {
    $this->name = $name;
    print "����ä��㤤�ޤ�! {$name}�ؤ褦����\n";
  }
  // �����Ȥ���ʪ���ɲ�
  function addItem($name, $num) {
    if(isset($this->item[$name])) {
      $this->item[$name] += $num;
    } else {
      $this->item[$name] = $num;
    }
  }
  // �����Ȥ������ʪ��ɽ��
  function show() {
    foreach($this->item as $name=>$value) {
      print "$name:$value\n";
    }
  }
  // �ǥ��ȥ饯��
  function __destruct() {
    print "���꤬�Ȥ��������ޤ���!\n";
  }
}
?>
