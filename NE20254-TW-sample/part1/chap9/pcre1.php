<?php
require_once('mbregexdef.php');
$regex = "/($Ascii+|$Hkana+|$Zhiragana+|$Zkana+|$Kanji+)/x";
$str = "“ú–{Œê‚Æenglish(ƒGƒCƒS)";

if (preg_match_all($regex, $str, $regs)) {
  print_r($regs);
}
?>
