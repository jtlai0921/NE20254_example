<?php
$product = array('�ߤ���','�����','���');
?>
<html><body>
<h1>���ѽ����</h1>

<form action="fpdftpl.php" method="POST">
<table border=1>
��̾����<input type="text" name="name" size="20"><br>
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
<input type="submit" value="����">
</form>
</body></html>
