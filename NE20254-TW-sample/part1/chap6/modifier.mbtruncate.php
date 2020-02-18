<?php
/*
 * 進行mbtruncate修飾字處理的函式
 */
function smarty_modifier_mbtruncate($string, $length = 80, $etc = '...')
{
    if ($length == 0)
        return '';

    if (mb_strlen($string) > $length) { // 取得從前面開始到第 $length 個的字元
        $fragment = mb_substr($string, 0, $length);
        return $fragment.$etc;
    } else {
        return $string;
    }
}
?>
