<?php
header('Content-Type: text/html; charset=big5');
$product = array('橘子','柳橙','蘋果');
?>
<html><body>
<h1>建立估價單</h1>

<form action="fpdftpl.php" method="POST">
<table border=1>
姓名：<input type="text" name="name" size="20"><br>
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
<input type="submit" value="建立">
</form>
</body></html>
