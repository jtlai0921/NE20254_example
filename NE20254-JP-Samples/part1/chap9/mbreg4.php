<?php
 $str = "日本語　abc 文字列";  // 対象文字列
 print_r(mb_split('[　 ]',$str)); // 全角/半角スペースで分割
?>
