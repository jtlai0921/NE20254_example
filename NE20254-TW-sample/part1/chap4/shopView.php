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
<h1>�q��</h1>
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
    print "<h1>�t�e�a�I�M�I�ڤ覡</h1>";
    print <<<EOS
  <form action="shop.php" method="POST">
   �m�W:<input type="text" name="yourname" size="40" value="{$obj['yourname']}">
   <br />
   �a�}:<input type="text" name="address" size="40" value="{$obj['address']}">
   <br />
   �I�ڤ覡:
      �l������<input type="radio" name="payment" value="poffice" checked> 
      �Ȧ���b<input type="radio" name="payment" value="bank">
     <input type="submit">
  </form>
EOS;
  }

  function showLast($obj) {
    $method = array('poffice'=>'�l������','bank'=>'�Ȧ���b');
    print "<h1>�ʪ�����</h1>";
    $meth = $method[$obj['payment']];
    print <<<EOS
<pre>
   ���´f�U!
   
  �m�W:  {$obj['yourname']}
  �X�p���B:  {$obj['total']} ��
  �a�}: {$obj['address']}
  �I�ڤ覡: {$meth}
</pre>
<a href="shop.php">�~���ʪ�</a>
EOS;

  }

  function showSession() {
    print "<hr />";
    print "Session �e���W��:" . session_module_name() . "<br />";
    print "Session �O�s��m:" . session_save_path() . "<br />";
    print "Session �W��:" . session_name() . "<br />";
    print "Session ID:" . session_id() . "<br />";
    print "�֨�����:" . session_cache_limiter() . "<br />";
    print_r($_SESSION);
  }

}
?>
