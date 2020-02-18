<?php
// iモード絵文字判別関数(拡張絵文字領域を含む)
function is_imode_emoji($s) {
  $hbyte = ord($s[0]);
  $lbyte = ord($s[1]);
  if ($hbyte == 0xf8 && ($lbyte >= 0x9f && $lbyte <= 0xfc)) {
    return true;
  } else if ($hbyte == 0xf9 && 
       (($lbyte >= 0x40 && $lbyte <= 0x49) ||
        ($lbyte >= 0x72 && $lbyte <= 0x7e) ||
        ($lbyte >= 0x80 && $lbyte <= 0xfc))) {
    return true;
  }
  return false;
}

// 文字列中の絵文字をカットして返す
function imode_emoji_cut($s) {
   for ($i=0, $r = ''; $i<strlen($s); $i++) {
     $str = substr($s, $i, 2);
     if (is_imode_emoji($str)) { // 絵文字
       $i++; // 絵文字の下位バイトをスキップ
     } else { // 絵文字以外
       $r .= $str[0];
     }
  }
   return $r;
}
?>
