<?php
// i�⡼�ɳ�ʸ��Ƚ�̴ؿ�(��ĥ��ʸ���ΰ��ޤ�)
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

// ʸ������γ�ʸ���򥫥åȤ����֤�
function imode_emoji_cut($s) {
   for ($i=0, $r = ''; $i<strlen($s); $i++) {
     $str = substr($s, $i, 2);
     if (is_imode_emoji($str)) { // ��ʸ��
       $i++; // ��ʸ���β��̥Х��Ȥ򥹥��å�
     } else { // ��ʸ���ʳ�
       $r .= $str[0];
     }
  }
   return $r;
}
?>
