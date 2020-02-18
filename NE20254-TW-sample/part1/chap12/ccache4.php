<?php
// charset: utf-8

class Foo {
  function showHeader() { // 顯示標頭
    echo "this is header<br />";  
    echo time()."<hr />";  
  }

  function showBody() { // 顯示本文
    echo "this is body<br />";  
    echo time()."<hr />";  
  }

  function showFooter() { // 顯示頁尾
    echo "this is footer<br />";  
    echo time()."<hr />";  
  }
}

// 每1分鐘更新標頭1次
$key = $_SERVER['PHP_SELF'].'header';
eaccelerator_cache_output($key, "Foo::showHeader();", 60);

// 每10秒更新本文1次
$key = $_SERVER['PHP_SELF'].'body';
eaccelerator_cache_output($key, "Foo::showBody();", 10);

// 每5分鐘更新頁尾1次
$key = $_SERVER['PHP_SELF'].'footer';
eaccelerator_cache_output($key, "Foo::showFooter();", 300);
?>
