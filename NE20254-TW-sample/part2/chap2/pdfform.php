<?php
header('Content-Type: text/html; charset=big5');
$product = array('��l','�h��','ī�G');
?>
<html><body>
<h1>�إߦ�����</h1>

<form action="fpdftpl.php" method="POST">
<table border=1>
�m�W�G<input type="text" name="name" size="20"><br>
<?php
for ($i=0;$i<count($product);$i++){
  echo <<<EOS
  <tr>
  <td>{$product[$i]}</td>
  <td><input type="text" size="5" name="num[]"></td>
  </tr>
EOS;
}
?>
</table>
<input type="submit" value="�إ�">
</form>
</body></html>
