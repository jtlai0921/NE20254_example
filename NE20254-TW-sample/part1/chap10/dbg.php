<?php
define('USER_DEBUG', true); // �������ɳ]�w��false
function dbg_out ($var, $file, $line) {
  if (USER_DEBUG === true) {
    echo "<!-- debug:$file::$line : ";
    print_r($var);
    print " -->";
  }
}
?>
