<?php
require_once 'HTML/QuickForm.php';

/* �ե���������ѥ�����Хå��ؿ� */
function process_cb($values) {
  echo '<pre>';
  var_dump($values);
  echo '</pre>';
}

$qf = new HTML_QuickForm('order', 'POST');
$qf->setRequiredNote('<span style="font-size:80%; color:#ff0000;">*</span>
<span style="font-size:80%;">ɬ�ܤΥե������</span>');

// �ե���������
$qf->addElement('header','title','��ʸ�ե�����');
$qf->addElement('text','item','����');
$qf->addElement('text','number','�Ŀ�');

$payment = array();
$payment[] = $qf->createElement('radio',null,null,'��Կ���',1);
$payment[] = $qf->createElement('radio',null,null,'͹�ؿ���',2);
$qf->addGroup($payment,'payment','��ʧ��ˡ');
$qf->addElement('submit', 'submit', '����');

$qf->applyFilter('__ALL__', 'trim');
$qf->addRule('item','���ʤ�ɬ�����ꤷ�Ƥ�������','required');
$qf->addRule('number','�Ŀ���ɬ�����ꤷ�Ƥ�������','required', null, 'client');


if ($qf->validate()) { // �ե�����ǡ����򸡾�
  $qf->freeze(); // �ե�����ǡ��������
  $qf->process('process_cb', false); // �ե��������
}

$qf->display(); // �ե������ɽ��
?>
