<?php
require_once('XML_RSS.php');

define('NS_MARK', '@');
define('RSS_NS', 'HTTP://PURL.ORG/RSS/1.0/');
define('DC_NS', 'HTTP://PURL.ORG/DC/ELEMENTS/1.1/');

class XML_RSS_NS extends XML_RSS {

  function endHandler($parser, $element) {
    if ($element !== $this->stack[0]) {
      throw new Exception("XML data is not well-formed.");
    }
    array_shift($this->stack);
    if ($element == RSS_NS.NS_MARK.'ITEM') {
      $this->itemNum++;
    }
  }

  function cdataHandler($parser, $cdata) {
    list($nsParent, $parent) = explode(NS_MARK, $this->stack[1]);
    list($nsCurrent, $current) = explode(NS_MARK, $this->stack[0]);

    if (($parent == 'CHANNEL' || $parent == 'ITEM') && $nsParent != RSS_NS) {
      throw new Exception("Namespace of RSS is invalid.");      
    }

    if ($current == 'DATE' && $nsCurrent != DC_NS) {
      throw new Exception("Namespace of DC is invalid.");      
    }

    switch ($parent) {
    case 'CHANNEL':
      $this->channel[$current] .= trim($cdata);
      break;
    case 'ITEM':
      $this->items[$this->itemNum][$current] .= trim($cdata);
      break;
    }
  }

  function __construct ($rss, $srcenc = 'utf-8') {
    $this->fp = fopen($rss, "r") or die("couldn't open RSS file.");
    $this->parser = xml_parser_create_ns($srcenc, NS_MARK);
    xml_set_object($this->parser, $this);
    xml_set_element_handler($this->parser, "startHandler", "endHandler");
    xml_set_character_data_handler($this->parser, "cdataHandler");
    xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, true);
  }
}
?>
