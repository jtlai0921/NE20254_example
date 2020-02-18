<?php
define('USER_DEBUG', true); // デバッグ時以外はfalseに設定
function dbg_out ($var, $file, $line) {
  if (USER_DEBUG === true) {
    echo "<!-- debug:$file::$line : ";
    print_r($var);
    print " -->";
  }
}
?>
