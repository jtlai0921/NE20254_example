<?php
// i-mode繪文字判別函式(包含擴充繪文字範圍)
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

// 刪除字串中的繪文字後回傳
function imode_emoji_cut($s) {
   for ($i=0, $r = ''; $i<strlen($s); $i++) {
     $str = substr($s, $i, 2);
     if (is_imode_emoji($str)) { // 繪文字
       $i++; // 跳過繪文字的低位元組
     } else { // 不是繪文字
       $r .= $str[0];
     }
  }
   return $r;
}
?>
