// ²���d�������(�b��r�`�N:���n�ϥ�'"')
$template = file("imageparam.template.html");
$action = $_SERVER['PHP_SELF']."?cmd=create";
$now = date("D M j G:i:s T Y");
foreach ($template as $line) {
   $ret = eval("echo \"$line\";");
}
