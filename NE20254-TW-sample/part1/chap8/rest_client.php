<?php 
 header('Content-Type: text/html; charset=utf-8');
 $val = empty($_POST['num']) ? 1070051 : $_POST['num'];
?>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
<input type="text" name="num" value="<?php echo $val ?>">
<input type="submit">
</form>
<?php
 $base = "http://php/part1/chap8/rest_server.php";
 $params = array('fn'=>'getInfoByZIP', 'num'=>$val);
 // 產生查詢內容
 $query = '';
 foreach ($params as $key => $value) {
   $query .= "&$key=" . urlencode($value);
 }

 $xml = file_get_contents("$base?$query"); // 執行Web服務
 $xs = simplexml_load_string($xml); // 變換成SimpleXML物件
 print $xs->address;
?>
