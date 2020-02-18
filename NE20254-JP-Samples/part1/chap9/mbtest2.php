<?php
mb_http_output("EUC-JP");
$str = isset($_POST['str']) ? $_POST['str'] : "試験用文字"; // 入力初期化

print <<<EOS
<form method="post" action="{$_SERVER['PHP_SELF']}">
 <input type="text" name="str" value="$str" />
 <input type="submit"/>
</form>
EOS;
if (isset($_POST['str'])){
  print "文字コード判定:".mb_http_input()."<br />";
  print "文字コード判定(POST):".mb_http_input("p")."<br />";
  print "文字コード判定(GET):".mb_http_input("g")."<br />";
}
?>
