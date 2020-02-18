<?php
// 函式無法正常運作，因此改成引入的方式使用
//function evalparam( $param_template, $param_path )
//{
    // 處理 $param_template 檔案的內容 (使用 eval 函式)、
    // 而後將處理結果寫入 $param_path 檔案。
    $timestamp=date("D M j G:i:s T Y");
    $param_cont = join ('', file($param_template));
    //echo $param_cont;
    // 注意要處理的文字內容！ ( 不能使用 '"' 跟 '%' )
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
