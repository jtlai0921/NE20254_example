<?php // ���������d��
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
$b = new Foo(2); // �Ȥ��P������
$c = $a;         // �ƻs����
$d = clone $a;   // ����ƻs(�Ȥ��P������)
$e = new Boo(1); // ���P���O

// �P���O�Ȥ��P
print bool2str($a==$b); // ��X: false
print bool2str($a===$b); // ��X: false
print "\n";
// �P���O�ȬۦP
$b->value = 1;
print bool2str($a==$b); // ��X: true 
print bool2str($a===$b); // ��X: false
print "\n";
// �P���O�P����
print bool2str($a==$c); // ��X: true 
print bool2str($a===$c); // ��X: true
print "\n";
// �P���O�ȬۦP (���P����)
print bool2str($a==$d); // ��X: true 
print bool2str($a===$d); // ��X: false
print "\n";
// ���P���O�ȬۦP
print bool2str($a==$e); // ��X: false
print bool2str($a===$e); // ��X: false
print "\n";
?>
