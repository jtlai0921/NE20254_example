<?php
 $str = "中文　abc 字串";  // 對象字串
 print_r(mb_split('[　 ]',$str)); // 以全形/半形空白來分割
?>
