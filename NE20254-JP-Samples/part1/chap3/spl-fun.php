<?php
 $dir = new RecursiveDirectoryIterator('.');
 print_r(class_parents($dir)); // ����: DirectoryIterator
 print_r(class_implements($dir)); // ����: array('Traversable','Iterator','RecursiveIterator')
?>
