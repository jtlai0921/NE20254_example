<?php
// ・ユ・。・��ッ・キ・逾��ヌ、マ、ヲ、゛、ッ、讀ォ、ハ、、、ソ、皈、・��ッ・��シ・ノ、キ、ニサネ、ヲ、隍ヲ、ヒ、キ、ソ。」
//function evalparam( $param_template, $param_path )
//{
    // $param_template ・ユ・。・、・�Ε曠埋魯法���、・ミ、テ、ニ(evalエリソ����ネ、テ、ニ)。「
    // 、ス、ホキ�乾奸Å $param_path ・ユ・。・、・�Ε劵���ュスミ、ケ。」
    $timestamp=date("D M j G:i:s T Y");
    $param_cont = join ('', file($param_template));
    //echo $param_cont;
    // ・、・��。・�Ε諭▲紂▲泪魯�サ��ヒ、エテ�殴罅���ェ。ハ '"' 、� '%' 、マサネ、ィ、ハ、、 。ヒ
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
