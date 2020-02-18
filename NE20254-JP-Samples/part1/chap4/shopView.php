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
<h1>����ʸ</h1>
<br>
<form action="shop.php" method="POST">
<table>
EOS;
    foreach($obj['id'] as $i => $id) {
      print <<<EOS
 <tr>
   <td>{$obj['name'][$i]}</td><td>{$obj['price'][$i]}��</td>
   <td><input type="text" name="$id" size="2">��</td>
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
    print "<h1>���Ϥ���Ȼ�ʧ��ˡ</h1>";
    print <<<EOS
  <form action="shop.php" method="POST">
   ��̾��:<input type="text" name="yourname" size="40" value="{$obj['yourname']}">
   <br />
   ȯ����:<input type="text" name="address" size="40" value="{$obj['address']}">
   <br />
   ��ʧ����ˡ:
      ͹�ؿ���<input type="radio" name="payment" value="poffice" checked> 
      ��Կ���<input type="radio" name="payment" value="bank">
     <input type="submit">
  </form>
EOS;
  }

  function showLast($obj) {
    $method = array('poffice'=>'͹�ؿ���','bank'=>'��Կ���');
    print "<h1>�㤤ʪ��λ</h1>";
    $meth = $method[$obj['payment']];
    print <<<EOS
<pre>
   ���꤬�Ȥ��������ޤ���!
   
  ��̾��:  {$obj['yourname']}
  ��׶��:  {$obj['total']} ��
  ������: {$obj['address']}
  ����ʧ����ˡ: {$meth}
</pre>
<a href="shop.php">�㤤ʪ��³����</a>
EOS;

  }

  function showSession() {
    print "<hr />";
    print "���å���󥳥�ƥ�̾:" . session_module_name() . "<br />";
    print "���å������¸��:" . session_save_path() . "<br />";
    print "���å����̾:" . session_name() . "<br />";
    print "���å����ID:" . session_id() . "<br />";
    print "����å����ߥå�:" . session_cache_limiter() . "<br />";
    print_r($_SESSION);
  }

}
?>
