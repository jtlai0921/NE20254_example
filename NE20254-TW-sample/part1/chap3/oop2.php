<?php
class MyShop {
  private $obj;

  function __construct($obj) {
    $this->obj = $obj;
  }

  function __call($method, $args) {
    print $method."::".implode($args,",")."\n";
    if (isset($this->obj) && method_exists($this->obj, $method)) {
      return call_user_func_array(array($this->obj, $method), $args);
    }
  }
}

class Calculate {
  private $items = 0;
  function add($num){
    $this->items += $num;
  }
  function sum(){
    return $this->items;
  }
}

$obj = new Calculate();
$shop = new MyShop($obj);

$shop->add(2);
print $shop->sum();
?>
