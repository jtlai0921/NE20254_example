// ��r�ꤤ��ø��r�ܴ����ϥܳs����^��
function imode_emoji2image($s) {
   for ($i=0, $r = ''; $i<strlen($s); $i++) {
     $str = substr($s, $i, 2);
     if (is_imode_emoji($str)) { // ø��r
       $r .= sprintf("<img src=\"images/%2X%2X.gif\" />", 
                     ord($str[0]), ord($str[1]));
       $i++; // ���Lø��r���C�줸��
     } else { // ���Oø��r
       $r .= $str[0];
     }
  }
   return $r;
}

