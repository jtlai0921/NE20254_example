<?php // jcode.php�佐�胡
require_once('jcode.php');

print <<<EOS
<form method="post" action="{$_SERVER['PHP_SELF']}">
<input type="text" name="str" />
<input type="hidden" name="dummy" value="日本語文字コード検出用" />
<input type="submit" />
</form>
EOS;

if (isset($_POST['str'])){
  $code = AutoDetect($_POST['dummy']); // 遂�O�rじ�X
  print JCodeConvert($_POST['str'], $code, 1); // �HEUC-JP翠�X
}
?>

