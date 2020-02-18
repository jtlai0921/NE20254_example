<?php
header('Content-Type: text/html; charset=utf-8');
require_once('AmazonLib.php');
$keyword = 'PHP4徹底攻略';

$base = "http://webservices.amazon.co.jp/onca/xml?Service=AWSECommerceService";
$params = array('SubscriptionId'=>'XXXXXXXXXXXXXXXXXXXX',
                'Operation'=>'ItemSearch',
                'SearchIndex'=>'Books',
                'Keywords'=>$keyword);
// 產生查詢字串
$query = '';
foreach ($params as $key => $value) {
  $query .= "&$key=" . urlencode($value);
}

$url = "$base$query";
$xml = file_get_contents($url); // 執行Web服務
$xs = simplexml_load_string($xml);  // 變換成SimpleXML物件
AmazonResult::showItemSearch($xs->Items->Item); // 顯示結果
?>
