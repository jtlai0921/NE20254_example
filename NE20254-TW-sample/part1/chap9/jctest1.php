<?php // jcode.php������
require_once('jcode.php');

print <<<EOS
<form method="post" action="{$_SERVER['PHP_SELF']}">
<input type="text" name="str" />
<input type="hidden" name="dummy" value="���ܸ�ʸ�������ɸ�����" />
<input type="submit" />
</form>
EOS;

if (isset($_POST['str'])){
  $code = AutoDetect($_POST['dummy']); // ��O�r���X
  print JCodeConvert($_POST['str'], $code, 1); // �HEUC-JP��X
}
?>

