<html><head><meta http-equiv="Content-Type" content="text/html; charset=big5" /><body>
<?php
if (isset($_POST['str'])){
  $code = mb_detect_encoding($_POST['str']);
} elseif (isset($_GET['str'])){
  $code = mb_detect_encoding($_GET['str']);
} elseif (isset($_COOKIE['str'])){
  $code = mb_detect_encoding($_COOKIE['str']);
}
print "<!-- encoding:$code -->";
print "字元碼: $code";
?>
</body></html>
