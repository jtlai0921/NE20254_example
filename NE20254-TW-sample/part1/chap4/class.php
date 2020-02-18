<?php
class MyClass {
  public $price;
  private $item;
  
  function __construct($name) {
    $this->item = $name;
  }

  function show() {
    return $this->item .":". $this->price;
  }
} 

session_start();

$c = new MyClass('orange');
$c->price = 200;
$_SESSION['c'] = $c;
print $c->show();
?>
