<?php
$dom = new Domdocument();
$dom->loadXML('<?xml version="1.0" encoding="utf-8" ?><foo></foo>');
$root = $dom->documentElement;

try {
  $root->appendChild($root);
} catch (DOMException $e) {
  print "Message: " . $e->getMessage() . "\n";
  print "Code: " . $e->getCode() . "\n";
  print "File: " . $e->getFile() . "\n";
  print "Line: " . $e->getLine() . "\n";
}
?>
