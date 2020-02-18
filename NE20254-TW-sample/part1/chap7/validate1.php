<?php
 $dom = new domDocument();
 $dom->load('simple1i.xml');
 if (!$dom->validate()) {
   print "NG\n";
 } else {
   print "OK\n";
 }
?>
