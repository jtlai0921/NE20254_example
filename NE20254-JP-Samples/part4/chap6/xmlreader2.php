<?php
$reader = new XMLReader();
$reader->open('phpnews.rdf');
while ($reader->read()) {
        if ($reader->nodeType != XMLREADER_END_ELEMENT) {
                print "Node Name: ".$reader->name."\n";
                print "Node Value: ".$reader->value."\n";
                print "Node Depth: ".$reader->depth."\n";
                print "Node Type: ".$reader->nodeType."\n";
                if ($reader->nodeType==XMLREADER_ELEMENT && $reader->hasAttributes) {
                        $attr = $reader->moveToFirstAttribute();
                        while ($attr) {
                                print "   Attribute Name: ".$reader->name."\n";
                                print "   Attribute Value: ".$reader->value."\n";
                                $attr = $reader->moveToNextAttribute();
                        }
                }
                print "\n";
        }
}
?>
