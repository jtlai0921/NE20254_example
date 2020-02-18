<?php
// ���顼�ϥ�ɥ�ؿ�
function error_handler ($errno, $errmsg, $file, $line, $vars) {
  $time = date("Y-m-d H:i:s");  // ���顼ȯ������
  // ���顼�μ����ɽ��Ϣ����������
  $errortype = array (1=>"Error",2=>"Warning",4=>"Parsing Error",8=>"Notice",
                      16=>"Core Error",32=>"Core Warning",
                      64=>"Compile Error",128=>"Compile Warning",
                      256=>"User Error",512=>"User Warning",
                      1024=>"User Notice",2048=>"Strict Notice");
  $err = <<<EOS
 <errorentry>
    <time>$time</time>
    <number>$errno</number>
    <type>$errortype[$errno]</type>
    <errmsg>$errmsg</errmsg>
    <filename>$file</filename>
    <linenum>$line</linenum>
EOS;
  // �桼��������顼/���Τξ����ѿ����ͤ�Ͽ
  if ($errno & (E_USER_ERROR | E_USER_WARNING | E_USER_NOTICE)){
    $err .= "\n<vars>" . serialize($vars) . "</vars>";
  } 
  $err .= "\n</errorentry>\n";

  error_log($err, 3, "/tmp/error.log");    // ��������¸
  if ($errno == E_ERROR || $errno == E_USER_ERROR){ // ����ʥ��顼�ϥ᡼�������
    mb_send_mail("admin@example.com","���顼ȯ������",$err);
    echo "����������ޤ��󡣥����ƥ��������ˤ�ꥵ���ӥ��������Ǥ���";
    die();
  }
}
set_error_handler("error_handler"); // ���顼�ϥ�ɥ�ؿ�������
?>