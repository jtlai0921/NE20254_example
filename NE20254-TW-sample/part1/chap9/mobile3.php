// 把字串中的繪文字變換成圖示連結後回傳
function imode_emoji2image($s) {
   for ($i=0, $r = ''; $i<strlen($s); $i++) {
     $str = substr($s, $i, 2);
     if (is_imode_emoji($str)) { // 繪文字
       $r .= sprintf("<img src=\"images/%2X%2X.gif\" />", 
                     ord($str[0]), ord($str[1]));
       $i++; // 跳過繪文字的低位元組
     } else { // 不是繪文字
       $r .= $str[0];
     }
  }
   return $r;
}

