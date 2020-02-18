<?php
header('Content-Type: text/html; charset=utf-8');
$str = "日本語とenglish(エイゴ)";
if (preg_match_all("/[ア-ン]/u", $str, $regs)) {
  print $str = join($regs[0]); // 輸出: エイゴ
}
?>
