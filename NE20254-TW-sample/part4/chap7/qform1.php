<?php
require_once 'HTML/QuickForm.php';

header('Content-Type: text/html; charset=utf-8');

/* 表單處理用回呼函式 */
function process_cb($values) {
  echo '<pre>';
  var_dump($values);
  echo '</pre>';
}

$qf = new HTML_QuickForm('order', 'POST');
$qf->setRequiredNote('<span style="font-size:80%; color:#ff0000;">*</span>
<span style="font-size:80%;">必填欄位</span>');

// 建立表單
$qf->addElement('header','title','訂購用表單');
$qf->addElement('text','item','商品');
$qf->addElement('text','number','個數');

$payment = array();
$payment[] = $qf->createElement('radio',null,null,'銀行轉帳',1);
$payment[] = $qf->createElement('radio',null,null,'郵局匯款',2);
$qf->addGroup($payment,'payment','付款方式');
$qf->addElement('submit', 'submit', '傳送');

$qf->applyFilter('__ALL__', 'trim');
$qf->addRule('item','一定要指定商品','required');
$qf->addRule('number','一定要指定個數','required', null, 'client');


if ($qf->validate()) { // 檢證表單資料
  $qf->freeze(); // 固定表單資料
  $qf->process('process_cb', false); // 處理表單
}

$qf->display(); // 顯示表單
?>
