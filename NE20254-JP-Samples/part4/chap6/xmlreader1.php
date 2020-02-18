<?php
 $xml = new XMLReader();
 $xml->open('phpnews.rdf');
 while ($xml->read()) {
   switch ($xml->nodeType) {
    case XMLREADER_ELEMENT:
      print "\n" . str_repeat("\t", $xml->depth);
      print $xml->localName . "\t";
      if ($xml->hasAttributes) {
        $attr = $xml->moveToFirstAttribute();
        while ($attr) {
          print "{$xml->name} -> {$xml->value},"; 
          $attr = $xml->moveToNextAttribute();
        }
      }
      break;
    case XMLREADER_TEXT:
      print $xml->value;
      break;
   }
 }
?>