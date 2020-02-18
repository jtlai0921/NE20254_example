<?php
 $str = "\x1b\$G\x21\x0fabc"; // 含有繪文字的字串
 $regex = '/\x1b\$([E-G])([\x21-\x7a])+\x0f/e'; // 比對繪文字的正規表示式
 echo preg_replace($regex, 'sprintf("<img src=\"%02X%02X.gif\">",
     ord("$1"),ord("$2"))', $str); // 把繪文字變換成圖示連結後輸出
?>

