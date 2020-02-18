<?php
require_once 'HTML/QuickForm.php';

/* フォーム処理用コールバック関数 */
function process_cb($values) {
  echo '<pre>';
  var_dump($values);
  echo '</pre>';
}

$qf = new HTML_QuickForm('order', 'POST');
$qf->setRequiredNote('<span style="font-size:80%; color:#ff0000;">*</span>
<span style="font-size:80%;">必須のフィールド</span>');

// フォーム生成
$qf->addElement('header','title','注文フォーム');
$qf->addElement('text','item','商品');
$qf->addElement('text','number','個数');

$payment = array();
$payment[] = $qf->createElement('radio',null,null,'銀行振込',1);
$payment[] = $qf->createElement('radio',null,null,'郵便振替',2);
$qf->addGroup($payment,'payment','支払方法');
$qf->addElement('submit', 'submit', '送信');

$qf->applyFilter('__ALL__', 'trim');
$qf->addRule('item','商品は必ず指定してください','required');
$qf->addRule('number','個数は必ず指定してください','required', null, 'client');


if ($qf->validate()) { // フォームデータを検証
  $qf->freeze(); // フォームデータを固定
  $qf->process('process_cb', false); // フォーム処理
}

$qf->display(); // フォームを表示
?>
