/*
 * 修正子 mbtruncate の処理を行う関数
 */
function smarty_modifier_mbtruncate($string, $length = 80, $etc = '...')
{
    if ($length == 0)
        return '';

    if (mb_strlen($string) > $length) { // 前から$length文字目までを取得
        $fragment = mb_substr($string, 0, $length);
        return $fragment.$etc;
    } else {
        return $string;
    }
}
