<?php // オブジェクトの比較の例
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
$b = new Foo(2); // 値が異なるインスタンス
$c = $a;         // オブジェクトのコピー
$d = clone $a;   // オブジェクトの複製(値が異なるインスタンス)
$e = new Boo(1); // 異なるクラス

// 同一クラスで値が異なる
print bool2str($a==$b); // 出力: false
print bool2str($a===$b); // 出力: false
print "\n";
// 同一クラスで値が同じ
$b->value = 1;
print bool2str($a==$b); // 出力: true 
print bool2str($a===$b); // 出力: false
print "\n";
// 同一クラスの同一インスタンス
print bool2str($a==$c); // 出力: true 
print bool2str($a===$c); // 出力: true
print "\n";
// 同一クラスで値が同じ(異なるインスタンス)
print bool2str($a==$d); // 出力: true 
print bool2str($a===$d); // 出力: false
print "\n";
// 異なるクラスで値が同じ
print bool2str($a==$e); // 出力: false
print bool2str($a===$e); // 出力: false
print "\n";
?>
