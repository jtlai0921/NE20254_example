<?php // jcode.phpªº´ú¸Õ
require_once('jcode.php');

print <<<EOS
<form method="post" action="{$_SERVER['PHP_SELF']}">
<input type="text" name="str" />
<input type="hidden" name="dummy" value="ÆüËÜ¸ìÊ¸»ú¥³¡¼¥É¸¡½ÐÍÑ" />
<input type="submit" />
</form>
EOS;

if (isset($_POST['str'])){
  $code = AutoDetect($_POST['dummy']); // ¿ë§O¦r¤¸½X
  print JCodeConvert($_POST['str'], $code, 1); // ¥HEUC-JP¿é¥X
}
?>

