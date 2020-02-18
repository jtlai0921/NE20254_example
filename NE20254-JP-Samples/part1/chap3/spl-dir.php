<?php
$dir = new DirectoryIterator('.');

foreach($dir as $key => $value) {
  if (!$dir->isDot()){ // . で始まるファイル以外を表示
    print "$key => $value\n";
  }
}
?>
