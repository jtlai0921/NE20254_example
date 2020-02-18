<?php
 require_once('AmazonLib.php');
 $keyword = mb_convert_encoding('PHP4Ű�칶ά','UTF8');
 $wsdl = 'http://webservices.amazon.com/AWSECommerceService/JP/AWSECommerceService.wsdl';

 $client = new SoapClient($wsdl);

 // �ꥯ�����ȥѥ�᡼������
$req = new AmazonRequest($keyword); // ʣ�緿
$params = array('SubscriptionId' => 'XXXXXXXXXXXXXXXXXXXX',
                'Request' => $req);
 try {
  $xs = $client->ItemSearch($params); // �����¹�
 } catch (SoapFault $e) {
   echo $e; // �㳰��ɽ��
 }
 AmazonResult::showItemSearch($xs->Items->Item); // ��̤�ɽ��
?>
