<?php
require_once('AmazonLib.php');
$keyword = mb_convert_encoding('PHP4Ű�칶ά','UTF8');

$base = "http://webservices.amazon.co.jp/onca/xml?Service=AWSECommerceService";
$params = array('SubscriptionId'=>'XXXXXXXXXXXXXXXXXXXX',
                'Operation'=>'ItemSearch',
                'SearchIndex'=>'Books',
                'Keywords'=>$keyword);
// ������ʸ��������
$query = '';
foreach ($params as $key => $value) {
  $query .= "&$key=" . urlencode($value);
}

$url = "$base$query";
$xml = file_get_contents($url); // Web�����ӥ��¹�
$xs = simplexml_load_string($xml); // SimpleXML���֥������Ȥ��Ѵ�
AmazonResult::showItemSearch($xs->Items->Item); // ��̤�ɽ��
?>
