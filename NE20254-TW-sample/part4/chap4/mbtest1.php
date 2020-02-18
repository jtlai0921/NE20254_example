<?php
 $str_orig = 'ÆüËÜ¸ì'; // EUC-JP
 $str = mb_convert_encoding($str_orig,'UTF-8');
 echo mb_detect_encoding($str),"\n"; // ½ÐÎÏ: UTF-8
 echo mb_strwidth($str,'UTF-8'),"\n"; // ½ÐÎÏ: 6
 echo mb_preferred_mime_name('SJIS'),"\n"; // ½ÐÎÏ: Shift_JIS
 echo mb_convert_case('£è£å£ì£ì£ï¡¡£÷£ï£ò£ì£ä',MB_CASE_TITLE),"\n"; // ½ÐÎÏ: £È£å£ì£ì£ï¡¡£×£ï£ò£ì£ä
 echo mb_convert_kana('¥Ý¥ë¥È¥¬¥ë'),"\n"; // ½ÐÎÏ: ¥Ý¥ë¥È¥¬¥ë
 echo mb_strcut('ÆüËÜ¸ì¤ÎPHPËÜ',2,3),"\n"; // ½ÐÎÏ: ËÜ
 echo mb_substr('ÆüËÜ¸ì¤ÎPHPËÜ',2,3),"\n"; // ½ÐÎÏ: ¸ì¤ÎP
 echo mb_strwidth('ÆüËÜ¸ì¤ÎPHPËÜ'),"\n"; // ½ÐÎÏ: 13
?>
