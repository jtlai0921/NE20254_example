<?php
 header('Content-Type: text/html; charset=utf-8');
 require_once('AmazonLib.php');
 $keyword = 'PHP4徹底攻略';
 $params = array(
  "location"=>"http://soap.amazon.co.jp/onca/soap?Service=AWSECommerceService",
  "uri"=>"http://webservices.amazon.com/AWSECommerceService/2004-11-10");

 $client = new SoapClient(NULL,$params);

 // 產生請求參數
 $sid = new SoapParam('XXXXXXXXXXXXXXXXXXXX','SubscriptionId');
 $req = new SoapVar(new AmazonRequest($keyword), SOAP_ENC_OBJECT);
 $request = new SoapParam($req,'Request');

 try {
  $xs = $client->ItemSearch($sid, $request); //執行檢索
 } catch (SoapFault $e) {
  echo $e; //顯示例外
 }
 AmazonResult::showItemSearch($xs['Items']->Item); //顯示結果
?>
