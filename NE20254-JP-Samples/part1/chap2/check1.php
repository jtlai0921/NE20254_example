<?php
require_once 'sanitize.php';

// �桼������
$_POST['price'] = '1450\0<script>1';
$_POST['name'] = '<script> --';
$_POST['keyword'] = "foo ' -- DELETE ";

// ���˥������ѥ롼��
$rules['price'] = array('type'=>'int', 'ctype'=>'digit');
$rules['name']  = array('type'=>'string', 'regex'=>'/^[a-z]+$/',
                        'action'=>'htmlentities');
$rules['address']  = array('type'=>'string', 'required'=>true);
$rules['keyword']  = array('type'=>'string', 'action'=>'addslashes');

$result = formSanitize($_POST, $rules); // ���˥������¹�
print_r($result); // Ƚ����
print_r($_POST); // ���˥�������Υѥ�᡼��
?>
