<?php

class Foo {
  function showHeader() { // �إå�����ɽ��
    echo "this is header<br />";  
    echo time()."<hr />";  
  }

  function showBody() { // �ܥǥ�������ɽ��
    echo "this is body<br />";  
    echo time()."<hr />";  
  }

  function showFooter() { // �եå�����ɽ��
    echo "this is footer<br />";  
    echo time()."<hr />";  
  }
}

// �إå���1ʬ�˰�󹹿�
$key = $_SERVER['PHP_SELF'].'header';
eaccelerator_cache_output($key, "Foo::showHeader();", 60);

// �ܥǥ�����10�ä˰�󹹿�
$key = $_SERVER['PHP_SELF'].'body';
eaccelerator_cache_output($key, "Foo::showBody();", 10);

// �եå���5ʬ��1�󹹿�
$key = $_SERVER['PHP_SELF'].'footer';
eaccelerator_cache_output($key, "Foo::showFooter();", 300);
?>
