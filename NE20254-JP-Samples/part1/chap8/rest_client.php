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
 // ������ʸ��������
 $query = '';
 foreach ($params as $key => $value) {
   $query .= "&$key=" . urlencode($value);
 }

 $xml = file_get_contents("$base?$query"); // Web�����ӥ��¹�
 $xs = simplexml_load_string($xml); // SimpleXML���֥������Ȥ��Ѵ�
 print $xs->address;
?>
