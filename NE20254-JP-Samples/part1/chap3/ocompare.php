<?php // ���֥������Ȥ���Ӥ���
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
$b = new Foo(2); // �ͤ��ۤʤ륤�󥹥���
$c = $a;         // ���֥������ȤΥ��ԡ�
$d = clone $a;   // ���֥������Ȥ�ʣ��(�ͤ��ۤʤ륤�󥹥���)
$e = new Boo(1); // �ۤʤ륯�饹

// Ʊ�쥯�饹���ͤ��ۤʤ�
print bool2str($a==$b); // ����: false
print bool2str($a===$b); // ����: false
print "\n";
// Ʊ�쥯�饹���ͤ�Ʊ��
$b->value = 1;
print bool2str($a==$b); // ����: true 
print bool2str($a===$b); // ����: false
print "\n";
// Ʊ�쥯�饹��Ʊ�쥤�󥹥���
print bool2str($a==$c); // ����: true 
print bool2str($a===$c); // ����: true
print "\n";
// Ʊ�쥯�饹���ͤ�Ʊ��(�ۤʤ륤�󥹥���)
print bool2str($a==$d); // ����: true 
print bool2str($a===$d); // ����: false
print "\n";
// �ۤʤ륯�饹���ͤ�Ʊ��
print bool2str($a==$e); // ����: false
print bool2str($a===$e); // ����: false
print "\n";
?>
