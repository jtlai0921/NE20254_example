<?php
 $str = "\x1b\$G\x21\x0fabc"; // 絵文字入り文字列
 $regex = '/\x1b\$([E-G])([\x21-\x7a])+\x0f/e'; // 絵文字にマッチする正規表現
 echo preg_replace($regex, 'sprintf("<img src=\"%02X%02X.gif\">",
     ord("$1"),ord("$2"))', $str); // 絵文字をイメージタグに変換して出力
?>

