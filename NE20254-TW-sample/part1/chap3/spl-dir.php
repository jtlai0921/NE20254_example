<?php
$dir = new DirectoryIterator('.');

foreach($dir as $key => $value) {
  if (!$dir->isDot()){ // ��ܤ��O�H . ���}�Y���ɮ�
    print "$key => $value\n";
  }
}
?>
