<?php  
require_once('err.inc'); // ���顼�����ϥ�ɥ���ɹ�
function divide($num, $den){  // �任��Ԥʤ��ؿ�
  if ($den==0){ // �����ξ��ϥ桼��������顼��ȯ��
    trigger_error("Cannot divide by zero",E_USER_ERROR);
  } else {
    return ($num/$den);
  }
}
$val = SOME_STRING; // �����̤����ʤΤǷٹ�ȯ����
echo divide(5, 0); // �����ˤ��桼������ν���ʥ��顼��ȯ����
?>
