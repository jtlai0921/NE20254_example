<?php
require_once('config.php');

class shopView {

  function showHeader($pageTitle = 'PHP Shop', $encoding = 'big5') {
    print <<<EOS
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=$encoding">
  <title>$pageTitle</title>
</head>
<body>
EOS;
  }

  function showFooter() {
    print "</body></html>";
  }

  function showList($obj) {

    print <<<EOS
<h1>訂單</h1>
<br>
<form action="shop.php" method="POST">
<table>
EOS;
    foreach($obj['id'] as $i => $id) {
      print <<<EOS
 <tr>
   <td>{$obj['name'][$i]}</td><td>{$obj['price'][$i]}元</td>
   <td><input type="text" name="$id" size="2">個</td>
 </tr>
EOS;
    }
    print <<<EOS
</table>
<input type="submit">
</form>
EOS;
  }

  function showShip($obj) {
    print "<h1>配送地點和付款方式</h1>";
    print <<<EOS
  <form action="shop.php" method="POST">
   姓名:<input type="text" name="yourname" size="40" value="{$obj['yourname']}">
   <br />
   地址:<input type="text" name="address" size="40" value="{$obj['address']}">
   <br />
   付款方式:
      郵局劃撥<input type="radio" name="payment" value="poffice" checked> 
      銀行轉帳<input type="radio" name="payment" value="bank">
     <input type="submit">
  </form>
EOS;
  }

  function showLast($obj) {
    $method = array('poffice'=>'郵局劃撥','bank'=>'銀行轉帳');
    print "<h1>購物結束</h1>";
    $meth = $method[$obj['payment']];
    print <<<EOS
<pre>
   謝謝惠顧!
   
  姓名:  {$obj['yourname']}
  合計金額:  {$obj['total']} 元
  地址: {$obj['address']}
  付款方式: {$meth}
</pre>
<a href="shop.php">繼續購物</a>
EOS;

  }

  function showSession() {
    print "<hr />";
    print "Session 容器名稱:" . session_module_name() . "<br />";
    print "Session 保存位置:" . session_save_path() . "<br />";
    print "Session 名稱:" . session_name() . "<br />";
    print "Session ID:" . session_id() . "<br />";
    print "快取限制:" . session_cache_limiter() . "<br />";
    print_r($_SESSION);
  }

}
?>
