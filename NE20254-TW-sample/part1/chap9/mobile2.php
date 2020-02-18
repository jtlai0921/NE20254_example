// ��r�ꤤø��r�ܴ����ƭȹ����^��
function imode_emoji2entity($s, $ucs = false) {
   for ($i=0, $r = ''; $i<strlen($s); $i++) {
     $str = substr($s, $i, 2);
     if (is_imode_emoji($str)) { // ø��r
       if ($ucs) { // �ܴ���Unicode
         $str = mb_convert_encoding($str,"UCS2","SJIS-win");
         $r .= sprintf("&#x%02X%02X;",ord($str[0]),ord($str[1]));
       } else { // �ܴ���Shift_JIS
         $code = ord($str[0])*256+ord($str[1]);
         $r .= sprintf("&#%05d;", $code);
       }
       $i++; // ���Lø��r���C�줸��
     } else { // ���Oø��r
       $r .= $str[0];
     }
  }
   return $r;
}
