<?php
$books = new ArrayObject(array('PHP4Ű�칶ά','PHP5Ű�칶ά'));

for ($i=0; $i<$books->count(); $i++){
  print $books[$i]."\n";
}
?>
