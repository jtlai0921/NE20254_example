<?php
require_once('mbregexdef.php');
$regex = "/($Ascii+|$Hkana+|$Zhiragana+|$Zkana+|$Kanji+)/x";
$str = "日本語とenglish(エイゴ)";

if (preg_match_all($regex, $str, $regs)) {
  print_r($regs);
}
?>
