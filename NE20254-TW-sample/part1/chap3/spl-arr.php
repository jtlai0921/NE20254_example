<?php
$books = new ArrayObject(array('PHP4������','PHP5������'));

for ($i=0; $i<$books->count(); $i++){
  print $books[$i]."\n";
}
?>
