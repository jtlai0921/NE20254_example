<?php // jcode.php�Υƥ���
require_once('jcode.php');

print <<<EOS
<form method="post" action="{$_SERVER['PHP_SELF']}">
<input type="text" name="str" />
<input type="hidden" name="dummy" value="���ܸ�ʸ�������ɸ�����" />
<input type="submit" />
</form>
EOS;

if (isset($_POST['str'])){
  $code = AutoDetect($_POST['dummy']); // ʸ�������ɤ�Ƚ��
  print JCodeConvert($_POST['str'], $code, 1); // EUC-JP�ǽ���
}
?>

