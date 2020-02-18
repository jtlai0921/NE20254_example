<?php
 require_once('AmazonLib.php');
 $keyword = mb_convert_encoding('PHP4徹底攻略','UTF8');
 $params = array(
  "location"=>"http://soap.amazon.co.jp/onca/soap?Service=AWSECommerceService",
  "uri"=>"http://webservices.amazon.com/AWSECommerceService/2004-11-10");

 $client = new SoapClient(NULL,$params);

 // リクエストパラメータ生成
 $sid = new SoapParam('XXXXXXXXXXXXXXXXXXXX','SubscriptionId');
 $req = new SoapVar(new AmazonRequest($keyword), SOAP_ENC_OBJECT);
 $request = new SoapParam($req,'Request');

 try {
  $xs = $client->ItemSearch($sid, $request); // 検索実行
 } catch (SoapFault $e) {
  echo $e; // 例外を表示
 }
 AmazonResult::showItemSearch($xs['Items']->Item); // 結果を表示
?>
