<?php
require_once("jcode-io.php");

print <<<EOS
<form method="post" action="{$_SERVER['PHP_SELF']}">
<input type="text" name="str" value="{$_POST['str']}" />
<input type="submit" />
</form>
EOS;
 
 if (isset($_POST['str'])){
  // POST���Ϥ�ʸ��������
  print "detected post encoding: {$enc_str[$detected_enc[METHOD_POST]]}<br />";
  // �ѿ��ǡ�����ʸ�������ɡ�=����ʸ�������ɡ�
  print "detected encoding: " . $enc_str[AutoDetect($_POST['str'])] . "<br />";  
  print "value of \$str:" . $_POST['str'] . "<br>"; // ���ϥǡ���
 }
?>