<?php
/*
 * �i��mbtruncate�׹��r�B�z���禡
 */
function smarty_modifier_mbtruncate($string, $length = 80, $etc = '...')
{
    if ($length == 0)
        return '';

    if (mb_strlen($string) > $length) { // ���o�q�e���}�l��� $length �Ӫ��r��
        $fragment = mb_substr($string, 0, $length);
        return $fragment.$etc;
    } else {
        return $string;
    }
}
?>
