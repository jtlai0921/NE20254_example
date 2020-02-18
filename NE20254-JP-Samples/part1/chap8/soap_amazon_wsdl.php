<?php
 require_once('AmazonLib.php');
 $keyword = mb_convert_encoding('PHP4徹底攻略','UTF8');
 $wsdl = 'http://webservices.amazon.com/AWSECommerceService/JP/AWSECommerceService.wsdl';

 $client = new SoapClient($wsdl);

 // リクエストパラメータ生成
$req = new AmazonRequest($keyword); // 複合型
$params = array('SubscriptionId' => 'XXXXXXXXXXXXXXXXXXXX',
                'Request' => $req);
 try {
  $xs = $client->ItemSearch($params); // 検索実行
 } catch (SoapFault $e) {
   echo $e; // 例外を表示
 }
 AmazonResult::showItemSearch($xs->Items->Item); // 結果を表示
?>
