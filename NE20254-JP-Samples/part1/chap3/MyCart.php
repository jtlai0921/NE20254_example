<?php
class MyCart {
  protected $item = array();
  public $name;
  // コンストラクタ
  function __construct($name) {
    $this->name = $name;
    print "いらっしゃいませ! {$name}へようこそ\n";
  }
  // カートに品物を追加
  function addItem($name, $num) {
    if(isset($this->item[$name])) {
      $this->item[$name] += $num;
    } else {
      $this->item[$name] = $num;
    }
  }
  // カートの中の品物を表示
  function show() {
    foreach($this->item as $name=>$value) {
      print "$name:$value\n";
    }
  }
  // デストラクタ
  function __destruct() {
    print "ありがとうございました!\n";
  }
}
?>
