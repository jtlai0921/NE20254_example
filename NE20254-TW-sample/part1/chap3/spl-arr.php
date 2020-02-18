<?php
$books = new ArrayObject(array('PHP4¹ý©³§ð²¤','PHP5¹ý©³§ð²¤'));

for ($i=0; $i<$books->count(); $i++){
  print $books[$i]."\n";
}
?>
