<?php
require_once 'sanitize.php';

// �ϥΪ̿�J
$_POST['price'] = '1450\0<script>1';
$_POST['name'] = '<script> --';
$_POST['keyword'] = "foo ' -- DELETE ";

// �L�`�ƥγW�h
$rules['price'] = array('type'=>'int', 'ctype'=>'digit');
$rules['name']  = array('type'=>'string', 'regex'=>'/^[a-z]+$/',
                        'action'=>'htmlentities');
$rules['address']  = array('type'=>'string', 'required'=>true);
$rules['keyword']  = array('type'=>'string', 'action'=>'addslashes');

$result = formSanitize($_POST, $rules); // ����L�`��
print_r($result); // �P�w���G
print_r($_POST); // �L�`�ƫ᪺�Ѽ�
?>
