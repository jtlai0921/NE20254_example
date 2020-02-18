<?php
 $str_orig = '���ܸ�'; // EUC-JP
 $str = mb_convert_encoding($str_orig,'UTF-8');
 echo mb_detect_encoding($str),"\n"; // ����: UTF-8
 echo mb_strwidth($str,'UTF-8'),"\n"; // ����: 6
 echo mb_preferred_mime_name('SJIS'),"\n"; // ����: Shift_JIS
 echo mb_convert_case('������������',MB_CASE_TITLE),"\n"; // ����: �ȣ����ף����
 echo mb_convert_kana('�ݥ�ȥ���'),"\n"; // ����: �ݥ�ȥ���
 echo mb_strcut('���ܸ��PHP��',2,3),"\n"; // ����: ��
 echo mb_substr('���ܸ��PHP��',2,3),"\n"; // ����: ���P
 echo mb_strwidth('���ܸ��PHP��'),"\n"; // ����: 13
?>
