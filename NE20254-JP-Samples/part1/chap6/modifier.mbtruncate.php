/*
 * ������ mbtruncate �ν�����Ԥ��ؿ�
 */
function smarty_modifier_mbtruncate($string, $length = 80, $etc = '...')
{
    if ($length == 0)
        return '';

    if (mb_strlen($string) > $length) { // ������$lengthʸ���ܤޤǤ����
        $fragment = mb_substr($string, 0, $length);
        return $fragment.$etc;
    } else {
        return $string;
    }
}
