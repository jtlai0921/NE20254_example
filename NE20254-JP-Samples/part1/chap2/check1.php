<?php
require_once 'sanitize.php';

// ユーザ入力
$_POST['price'] = '1450\0<script>1';
$_POST['name'] = '<script> --';
$_POST['keyword'] = "foo ' -- DELETE ";

// サニタイズ用ルール
$rules['price'] = array('type'=>'int', 'ctype'=>'digit');
$rules['name']  = array('type'=>'string', 'regex'=>'/^[a-z]+$/',
                        'action'=>'htmlentities');
$rules['address']  = array('type'=>'string', 'required'=>true);
$rules['keyword']  = array('type'=>'string', 'action'=>'addslashes');

$result = formSanitize($_POST, $rules); // サニタイズ実行
print_r($result); // 判定結果
print_r($_POST); // サニタイズ後のパラメータ
?>
