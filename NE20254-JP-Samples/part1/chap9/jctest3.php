<?php
require_once("jcode-io.php");

print <<<EOS
<form method="post" action="{$_SERVER['PHP_SELF']}">
<input type="text" name="str" value="{$_POST['str']}" />
<input type="submit" />
</form>
EOS;
 
 if (isset($_POST['str'])){
  // POST入力の文字コード
  print "detected post encoding: {$enc_str[$detected_enc[METHOD_POST]]}<br />";
  // 変数データの文字コード（=内部文字コード）
  print "detected encoding: " . $enc_str[AutoDetect($_POST['str'])] . "<br />";  
  print "value of \$str:" . $_POST['str'] . "<br>"; // 入力データ
 }
?>
