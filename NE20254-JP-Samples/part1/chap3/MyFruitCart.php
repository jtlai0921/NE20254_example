<?php
require_once('MyCart.php');
class MyFruitCart extends MyCart {
  private $place;
  // ���󥹥ȥ饯��
  function __construct($name, $place) {
    $this->place = $place;
    parent::__construct($name); // �ƥ��饹�Υ��󥹥ȥ饯���򥳡���
  }
  // �����Ȥ������ʪ��ɽ��
  function show() {
    print $this->name.$this->place."\n";
    foreach($this->item as $name=>$value) {
      print "$name $value ��\n";
    }
  }
}
?>
