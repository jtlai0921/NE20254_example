<?php
class MyArrayObject implements IteratorAggregate, ArrayAccess {
  protected $arr;
  function __construct($arr) {
    $this->arr = $arr;
  }
  function count() {
    return count($this->arr);
  }

  function getIterator() {
    return new ArrayIterator($this);
  }

  function offsetExists($key) {
    return array_key_exists($key, $this->arr);
  }

  function offsetGet($key){
    if (array_key_exists($key, $this->arr)) {
      return $this->arr[$key];
    }
  }

  function offsetSet($key, $value){
    if (array_key_exists($key, $this->arr)) {
      $this->arr[$key] = $value;
    }
  }

  function offsetUnSet($key){
    if (array_key_exists($key, $this->arr)) {
      unset($this->arr[$key]);
    }
  }  
}

$books = new MyArrayObject(array('PHP4¹ý©³§ð²¤','PHP5¹ý©³§ð²¤'));

for ($i=0; $i<$books->count(); $i++){
  print $books[$i]."\n";
}
?>
