<?php
require_once('MyCart.php');
class MyFruitCart extends MyCart {
  private $place;
  // �غc�l
  function __construct($name, $place) {
    $this->place = $place;
    parent::__construct($name); // �I�s�����O���غc�l
  }
  // ����ʪ����̪����~
  function show() {
    print $this->name.$this->place."\n";
    foreach($this->item as $name=>$value) {
      print "$name $value ��\n";
    }
  }
}
?>
