<?php
$str = '日本語';
echo mb_ereg_match("\w+",$str) ? "一致": "不一致","\n"; // 出力: 一致
if (mb_ereg("日(.)",$str,$regs)){
  print_r($regs); // $regs[0]='日本' $regs[1]='本'
}
echo mb_ereg_replace("語","人","日本語"); // 出力: 日本人
$regs = mb_split("[あ-ん]+","日本語は難しい");
print_r($regs); // $regs[0]='日本語',$regs[1]='難',$regs[2]=''
?>
