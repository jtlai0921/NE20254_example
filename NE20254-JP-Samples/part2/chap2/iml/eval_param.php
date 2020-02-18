<?php
// ¡¦¥æ¡¦¡£¡¦€€¥Ã¡¦¥­¡¦î§€€¥Ì¡¢¥Þ¡¢¥ò¡¢¡«¡¢¥Ã¡¢ì¦¥©¡¢¥Ï¡¢¡¢¡¢¥½¡¢â§¡¢¡¦€€¥Ã¡¦ö£¥·¡¦¥Î¡¢¥­¡¢¥Ë¥µ¥Í¡¢¥ò¡¢ð¦¥ò¡¢¥Ò¡¢¥­¡¢¥½¡£¡×
//function evalparam( $param_template, $param_path )
//{
    // $param_template ¡¦¥æ¡¦¡£¡¦¡¢¡¦ö¦¥Û¥ËäÏ¥Ë¡¢€€¡¢¡¦¥ß¡¢¥Æ¡¢¥Ë(eval¥¨¥ê¥½€€€€¥Í¡¢¥Æ¡¢¥Ë)¡£¡Ö
    // ¡¢¥¹¡¢¥Û¥­ö´¥Õ¡¢ò $param_path ¡¦¥æ¡¦¡£¡¦¡¢¡¦ö¦¥Ò¥¹€€¥å¥¹¥ß¡¢¥±¡£¡×
    $timestamp=date("D M j G:i:s T Y");
    $param_cont = join ('', file($param_template));
    //echo $param_cont;
    // ¡¦¡¢¡¦€€¡£¡¦ö¦¥Í¡¢¥å¡¢¥Þ¥Ï¥¯¥µ€€¥Ò¡¢¥¨¥Æú²¥æ¡¢€€¥§¡£¥Ï '"' ¡¢ä '%' ¡¢¥Þ¥µ¥Í¡¢¥£¡¢¥Ï¡¢¡¢ ¡£¥Ò
    //$ret = eval("echo \"$param_cont\";");
    $ret = eval("\$param_set = sprintf(\"$param_cont\");");
    if ( is_writeable("$param_path") || (! file_exists($param_path) && is_writeable(dirname($param_path)) ) ) {
	  $fp = fopen("$param_path", "w");
	  $ret = eval("fwrite(\$fp, \$param_set);");
	  fclose($fp);
    } else {
	  echo "<font color='red'>parameter file($param_path) is not writeable.</font><br />";
    }
//}
?>
