<?php
 header('Content-Type: text/html; charset=utf-8');
 require_once('AmazonLib.php');
 $keyword = 'PHP4徹底攻略';
 $wsdl = 'http://webservices.amazon.com/AWSECommerceService/JP/AWSECommerceService.wsdl';

 $client = new SoapClient($wsdl);

 // 產生請求參數
$req = new AmazonRequest($keyword); // 複合型
$params = array('SubscriptionId' => 'XXXXXXXXXXXXXXXXXXXX',
                'Request' => $req);
 try {
  $xs = $client->ItemSearch($params); // 執行檢索
 } catch (SoapFault $e) {
   echo $e; // 顯示例外
 }
 AmazonResult::showItemSearch($xs->Items->Item); // 顯示結果
?>
