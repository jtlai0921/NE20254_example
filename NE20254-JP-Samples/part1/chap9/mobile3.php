// ʸ������γ�ʸ���򥤥᡼���������Ѵ������֤�
function imode_emoji2image($s) {
   for ($i=0, $r = ''; $i<strlen($s); $i++) {
     $str = substr($s, $i, 2);
     if (is_imode_emoji($str)) { // ��ʸ��
       $r .= sprintf("<img src=\"images/%2X%2X.gif\" />", 
                     ord($str[0]), ord($str[1]));
       $i++; // ��ʸ���β��̥Х��Ȥ򥹥��å�
     } else { // ��ʸ���ʳ�
       $r .= $str[0];
     }
  }
   return $r;
}

