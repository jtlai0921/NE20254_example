<?php
 $str = "中文字串";
 // 以 Big5 輸出 (自動檢測字元碼)
 print mb_convert_encoding($str, "Big5");
 // 以 UTF-8 輸出 (原始字元碼在 Big5, UTF-8 之間判斷)
 print mb_convert_encoding($str, "UTF-8", array("Big5", "UTF-8"));
?>
