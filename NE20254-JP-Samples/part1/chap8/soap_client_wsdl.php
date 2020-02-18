<?php 
$val = empty($_POST['num']) ? 1070051 : $_POST['num'];
?>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
<input type="text" name="num" value="<?php echo $val ?>">
<input type="submit">
</form>
<?php
$wsdl = "http://www.example.com/php/ws/ZIPCode.wsdl";
$client = new SoapClient($wsdl);
try {
  print $client->getInfoByZIP($val);
} catch (SoapFault $e) {
  echo $e;
}
?>
