<?php 
 $val = empty($_POST['num']) ? 1070051 : $_POST['num'];
?>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
<input type="text" name="num" value="<?php echo $val ?>">
<input type="submit">
</form>
<?php
 $base = "http://www.example.com/php/ws/rest_server.php";
 $params = array('fn'=>'getInfoByZIP', 'num'=>$val);
 // クエリ文字列生成
 $query = '';
 foreach ($params as $key => $value) {
   $query .= "&$key=" . urlencode($value);
 }

 $xml = file_get_contents("$base?$query"); // Webサービス実行
 $xs = simplexml_load_string($xml); // SimpleXMLオブジェクトに変換
 print $xs->address;
?>
