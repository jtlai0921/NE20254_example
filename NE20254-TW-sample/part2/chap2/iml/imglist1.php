// 簡易範本的表示(在文字注意:不要使用'"')
$template = file("imageparam.template.html");
$action = $_SERVER['PHP_SELF']."?cmd=create";
$now = date("D M j G:i:s T Y");
foreach ($template as $line) {
   $ret = eval("echo \"$line\";");
}
