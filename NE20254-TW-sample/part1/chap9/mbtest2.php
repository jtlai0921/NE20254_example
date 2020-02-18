<?php
mb_http_output("Big5");
$str = isset($_POST['str']) ? $_POST['str'] : "測試用文字"; // 輸入值初始化

print <<<EOS
<form method="post" action="{$_SERVER['PHP_SELF']}">
 <input type="text" name="str" value="$str" />
<input type="hidden" name="dummy" value="防止判定錯誤" />
 <input type="submit"/>
</form>
EOS;
if (isset($_POST['str'])){
  print "字元碼判定:".mb_http_input()."<br />";
  print "字元碼判定(POST):".mb_http_input("P")."<br />";
  print "字元碼判定(GET):".mb_http_input("G")."<br />";
}
?>
