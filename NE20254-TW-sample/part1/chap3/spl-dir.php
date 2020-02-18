<?php
$dir = new DirectoryIterator('.');

foreach($dir as $key => $value) {
  if (!$dir->isDot()){ // 顯示不是以 . 為開頭的檔案
    print "$key => $value\n";
  }
}
?>
