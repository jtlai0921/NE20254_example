<?php
 $dom = domDocument::load('simple1.xml');
 $root = simplexml_import_dom($dom);
 $root->person[2] = '¹a¤ì¦¸­¦';
 $root->person[2]['id'] = 'a3';
 $dom = dom_import_simplexml($root);
 $persons = $dom->getElementsByTagName('person');
 foreach ($persons as $person) {
  print $person->nodeValue."\n";
 }
?>
