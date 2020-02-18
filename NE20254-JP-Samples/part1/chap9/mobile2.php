// ʸ������γ�ʸ������ͥ���ƥ��ƥ����Ѵ������֤�
function imode_emoji2entity($s, $ucs = false) {
   for ($i=0, $r = ''; $i<strlen($s); $i++) {
     $str = substr($s, $i, 2);
     if (is_imode_emoji($str)) { // ��ʸ��
       if ($ucs) { // Unicode�Ȥ����Ѵ�
         $str = mb_convert_encoding($str,"UCS2","SJIS-win");
         $r .= sprintf("&#x%02X%02X;",ord($str[0]),ord($str[1]));
       } else { // ���ե�JIS�Ȥ����Ѵ�
         $code = ord($str[0])*256+ord($str[1]);
         $r .= sprintf("&#%05d;", $code);
       }
       $i++; // ��ʸ���β��̥Х��Ȥ򥹥��å�
     } else { // ��ʸ���ʳ�
       $r .= $str[0];
     }
  }
   return $r;
}
