<?php
 $dir = new RecursiveDirectoryIterator('.');
 print_r(class_parents($dir)); // ��X: DirectoryIterator
 print_r(class_implements($dir)); // ��X: array('Traversable','Iterator','RecursiveIterator')
?>
