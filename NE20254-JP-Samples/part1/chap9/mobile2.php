// 文字列中の絵文字を数値エンティティに変換して返す
function imode_emoji2entity($s, $ucs = false) {
   for ($i=0, $r = ''; $i<strlen($s); $i++) {
     $str = substr($s, $i, 2);
     if (is_imode_emoji($str)) { // 絵文字
       if ($ucs) { // Unicodeとして変換
         $str = mb_convert_encoding($str,"UCS2","SJIS-win");
         $r .= sprintf("&#x%02X%02X;",ord($str[0]),ord($str[1]));
       } else { // シフトJISとして変換
         $code = ord($str[0])*256+ord($str[1]);
         $r .= sprintf("&#%05d;", $code);
       }
       $i++; // 絵文字の下位バイトをスキップ
     } else { // 絵文字以外
       $r .= $str[0];
     }
  }
   return $r;
}
