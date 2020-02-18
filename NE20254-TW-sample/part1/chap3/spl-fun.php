<?php
 $dir = new RecursiveDirectoryIterator('.');
 print_r(class_parents($dir)); // ¿é¥X: DirectoryIterator
 print_r(class_implements($dir)); // ¿é¥X: array('Traversable','Iterator','RecursiveIterator')
?>
