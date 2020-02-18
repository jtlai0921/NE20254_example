<?php
require_once('config.php');

class shopView {

  function showHeader($pageTitle = 'PHP Shop', $encoding = 'EUC-JP') {
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
<h1>ご注文</h1>
<br>
<form action="shop.php" method="POST">
<table>
EOS;
    foreach($obj['id'] as $i => $id) {
      print <<<EOS
 <tr>
   <td>{$obj['name'][$i]}</td><td>{$obj['price'][$i]}円</td>
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
    print "<h1>お届け先と支払方法</h1>";
    print <<<EOS
  <form action="shop.php" method="POST">
   お名前:<input type="text" name="yourname" size="40" value="{$obj['yourname']}">
   <br />
   発送先:<input type="text" name="address" size="40" value="{$obj['address']}">
   <br />
   支払い方法:
      郵便振替<input type="radio" name="payment" value="poffice" checked> 
      銀行振込<input type="radio" name="payment" value="bank">
     <input type="submit">
  </form>
EOS;
  }

  function showLast($obj) {
    $method = array('poffice'=>'郵便振替','bank'=>'銀行振込');
    print "<h1>買い物完了</h1>";
    $meth = $method[$obj['payment']];
    print <<<EOS
<pre>
   ありがとうございました!
   
  お名前:  {$obj['yourname']}
  合計金額:  {$obj['total']} 円
  配送先: {$obj['address']}
  お支払い方法: {$meth}
</pre>
<a href="shop.php">買い物を続ける</a>
EOS;

  }

  function showSession() {
    print "<hr />";
    print "セッションコンテナ名:" . session_module_name() . "<br />";
    print "セッション保存先:" . session_save_path() . "<br />";
    print "セッション名:" . session_name() . "<br />";
    print "セッションID:" . session_id() . "<br />";
    print "キャッシュリミッタ:" . session_cache_limiter() . "<br />";
    print_r($_SESSION);
  }

}
?>
