<?php
mb_http_output("Big5");
$str = isset($_POST['str']) ? $_POST['str'] : "���եΤ�r"; // ��J�Ȫ�l��

print <<<EOS
<form method="post" action="{$_SERVER['PHP_SELF']}">
 <input type="text" name="str" value="$str" />
<input type="hidden" name="dummy" value="����P�w���~" />
 <input type="submit"/>
</form>
EOS;
if (isset($_POST['str'])){
  print "�r���X�P�w:".mb_http_input()."<br />";
  print "�r���X�P�w(POST):".mb_http_input("P")."<br />";
  print "�r���X�P�w(GET):".mb_http_input("G")."<br />";
}
?>
