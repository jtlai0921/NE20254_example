<?php
$dir = new DirectoryIterator('.');

foreach($dir as $key => $value) {
  if (!$dir->isDot()){ // . �ǻϤޤ�ե�����ʳ���ɽ��
    print "$key => $value\n";
  }
}
?>
