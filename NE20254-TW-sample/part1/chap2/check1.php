<?php
require_once 'sanitize.php';

// 使用者輸入
$_POST['price'] = '1450\0<script>1';
$_POST['name'] = '<script> --';
$_POST['keyword'] = "foo ' -- DELETE ";

// 無害化用規則
$rules['price'] = array('type'=>'int', 'ctype'=>'digit');
$rules['name']  = array('type'=>'string', 'regex'=>'/^[a-z]+$/',
                        'action'=>'htmlentities');
$rules['address']  = array('type'=>'string', 'required'=>true);
$rules['keyword']  = array('type'=>'string', 'action'=>'addslashes');

$result = formSanitize($_POST, $rules); // 執行無害化
print_r($result); // 判定結果
print_r($_POST); // 無害化後的參數
?>
