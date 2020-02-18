<?php
require_once('AmazonLib.php');
$keyword = mb_convert_encoding('PHP4徹底攻略','UTF8');

$base = "http://webservices.amazon.co.jp/onca/xml?Service=AWSECommerceService";
$params = array('SubscriptionId'=>'XXXXXXXXXXXXXXXXXXXX',
                'Operation'=>'ItemSearch',
                'SearchIndex'=>'Books',
                'Keywords'=>$keyword);
// クエリ文字列生成
$query = '';
foreach ($params as $key => $value) {
  $query .= "&$key=" . urlencode($value);
}

$url = "$base$query";
$xml = file_get_contents($url); // Webサービス実行
$xs = simplexml_load_string($xml); // SimpleXMLオブジェクトに変換
AmazonResult::showItemSearch($xs->Items->Item); // 結果を表示
?>
