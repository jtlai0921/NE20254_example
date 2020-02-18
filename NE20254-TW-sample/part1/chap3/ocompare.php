<?php // 物件比較的範例
function bool2str($exp) {
  return ($exp === true) ? "true  " : "false ";
}

class Foo {
  public $value;
  function __construct($value) {
    $this->value = $value;
  }
}

class Boo {
  public $value;
  function __construct($value) {
    $this->value = $value;
  }
}

$a = new Foo(1);
$b = new Foo(2); // 值不同的實體
$c = $a;         // 複製物件
$d = clone $a;   // 物件複製(值不同的實體)
$e = new Boo(1); // 不同類別

// 同類別值不同
print bool2str($a==$b); // 輸出: false
print bool2str($a===$b); // 輸出: false
print "\n";
// 同類別值相同
$b->value = 1;
print bool2str($a==$b); // 輸出: true 
print bool2str($a===$b); // 輸出: false
print "\n";
// 同類別同實體
print bool2str($a==$c); // 輸出: true 
print bool2str($a===$c); // 輸出: true
print "\n";
// 同類別值相同 (不同實體)
print bool2str($a==$d); // 輸出: true 
print bool2str($a===$d); // 輸出: false
print "\n";
// 不同類別值相同
print bool2str($a==$e); // 輸出: false
print bool2str($a===$e); // 輸出: false
print "\n";
?>
