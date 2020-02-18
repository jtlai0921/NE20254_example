<?php // jcode.phpのテスト
require_once('jcode.php');

print <<<EOS
<form method="post" action="{$_SERVER['PHP_SELF']}">
<input type="text" name="str" />
<input type="hidden" name="dummy" value="日本語文字コード検出用" />
<input type="submit" />
</form>
EOS;

if (isset($_POST['str'])){
  $code = AutoDetect($_POST['dummy']); // 文字コードを判別
  print JCodeConvert($_POST['str'], $code, 1); // EUC-JPで出力
}
?>

