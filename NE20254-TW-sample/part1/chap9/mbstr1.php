<?php
 $str = "中文abc字串";
 print mb_substr($str, 1, 3); // 輸出: 文ab
 print mb_strcut($str, 1, 3); // 輸出: 中
?>
