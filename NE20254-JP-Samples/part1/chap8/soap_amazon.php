<?php
 require_once('AmazonLib.php');
 $keyword = mb_convert_encoding('PHP4Ű�칶ά','UTF8');
 $params = array(
  "location"=>"http://soap.amazon.co.jp/onca/soap?Service=AWSECommerceService",
  "uri"=>"http://webservices.amazon.com/AWSECommerceService/2004-11-10");

 $client = new SoapClient(NULL,$params);

 // �ꥯ�����ȥѥ�᡼������
 $sid = new SoapParam('XXXXXXXXXXXXXXXXXXXX','SubscriptionId');
 $req = new SoapVar(new AmazonRequest($keyword), SOAP_ENC_OBJECT);
 $request = new SoapParam($req,'Request');

 try {
  $xs = $client->ItemSearch($sid, $request); // �����¹�
 } catch (SoapFault $e) {
  echo $e; // �㳰��ɽ��
 }
 AmazonResult::showItemSearch($xs['Items']->Item); // ��̤�ɽ��
?>
