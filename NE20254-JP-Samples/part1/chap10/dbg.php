<?php
define('USER_DEBUG', true); // �ǥХå����ʳ���false������
function dbg_out ($var, $file, $line) {
  if (USER_DEBUG === true) {
    echo "<!-- debug:$file::$line : ";
    print_r($var);
    print " -->";
  }
}
?>
