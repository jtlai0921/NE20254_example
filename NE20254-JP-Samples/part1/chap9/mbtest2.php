<?php
mb_http_output("EUC-JP");
$str = isset($_POST['str']) ? $_POST['str'] : "���ʸ��"; // ���Ͻ����

print <<<EOS
<form method="post" action="{$_SERVER['PHP_SELF']}">
 <input type="text" name="str" value="$str" />
 <input type="submit"/>
</form>
EOS;
if (isset($_POST['str'])){
  print "ʸ��������Ƚ��:".mb_http_input()."<br />";
  print "ʸ��������Ƚ��(POST):".mb_http_input("p")."<br />";
  print "ʸ��������Ƚ��(GET):".mb_http_input("g")."<br />";
}
?>
