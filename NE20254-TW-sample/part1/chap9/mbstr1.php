<?php
 $str = "����abc�r��";
 print mb_substr($str, 1, 3); // ��X: ��ab
 print mb_strcut($str, 1, 3); // ��X: ��
?>
