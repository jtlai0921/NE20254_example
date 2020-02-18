// 文字列中の絵文字をイメージタグに変換して返す
function imode_emoji2image($s) {
   for ($i=0, $r = ''; $i<strlen($s); $i++) {
     $str = substr($s, $i, 2);
     if (is_imode_emoji($str)) { // 絵文字
       $r .= sprintf("<img src=\"images/%2X%2X.gif\" />", 
                     ord($str[0]), ord($str[1]));
       $i++; // 絵文字の下位バイトをスキップ
     } else { // 絵文字以外
       $r .= $str[0];
     }
  }
   return $r;
}

