// 把字串中繪文字變換成數值實體後回傳
function imode_emoji2entity($s, $ucs = false) {
   for ($i=0, $r = ''; $i<strlen($s); $i++) {
     $str = substr($s, $i, 2);
     if (is_imode_emoji($str)) { // 繪文字
       if ($ucs) { // 變換成Unicode
         $str = mb_convert_encoding($str,"UCS2","SJIS-win");
         $r .= sprintf("&#x%02X%02X;",ord($str[0]),ord($str[1]));
       } else { // 變換成Shift_JIS
         $code = ord($str[0])*256+ord($str[1]);
         $r .= sprintf("&#%05d;", $code);
       }
       $i++; // 跳過繪文字的低位元組
     } else { // 不是繪文字
       $r .= $str[0];
     }
  }
   return $r;
}
