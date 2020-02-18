<?php 
header('Content-Type: text/html; charset=utf-8');
$val = empty($_POST['num']) ? 1070051 : $_POST['num'];
?>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
<input type="text" name="num" value="<?php echo $val ?>">
<input type="submit">
</form>
<?php
$wsdl = "http://php/part1/chap8/ZIPCode.wsdl";
$client = new SoapClient($wsdl);
try {
  print $client->getInfoByZIP($val);
} catch (SoapFault $e) {
  echo $e;
}
?>
