<?php
 $dir = new RecursiveDirectoryIterator('.');
 print_r(class_parents($dir)); // 出力: DirectoryIterator
 print_r(class_implements($dir)); // 出力: array('Traversable','Iterator','RecursiveIterator')
?>
