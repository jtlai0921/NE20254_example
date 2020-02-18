<?php

class Foo {
  function showHeader() { // ヘッダ部を表示
    echo "this is header<br />";  
    echo time()."<hr />";  
  }

  function showBody() { // ボディー部を表示
    echo "this is body<br />";  
    echo time()."<hr />";  
  }

  function showFooter() { // フッタ部を表示
    echo "this is footer<br />";  
    echo time()."<hr />";  
  }
}

// ヘッダは1分に一回更新
$key = $_SERVER['PHP_SELF'].'header';
eaccelerator_cache_output($key, "Foo::showHeader();", 60);

// ボディーは10秒に一回更新
$key = $_SERVER['PHP_SELF'].'body';
eaccelerator_cache_output($key, "Foo::showBody();", 10);

// フッタは5分に1回更新
$key = $_SERVER['PHP_SELF'].'footer';
eaccelerator_cache_output($key, "Foo::showFooter();", 300);
?>
