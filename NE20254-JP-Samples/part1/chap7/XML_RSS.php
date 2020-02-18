<?php
class XML_RSS {
  protected $fp = null;
  protected $parser = null;
  protected $itemNum = 0;
  protected $stack = array();
  public $items = array();
  public $channel = array();

  function startHandler($parser, $element, $attribs) {
    array_unshift($this->stack, $element);
  }

  function endHandler($parser, $element) {
    if ($element !== $this->stack[0]) {
      throw new Exception("XML data is not well-formed.");
    }
    array_shift($this->stack);
    if ($element == 'ITEM') {
      $this->itemNum++;
    }
  }

  function cdataHandler($parser, $cdata) {
    $parent = $this->stack[1];
    $current = $this->stack[0];
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
    if (!($this->fp = fopen($rss, "r"))) {
      throw new Exception("couldn't open RSS file.");
    }
    $this->parser = xml_parser_create($srcenc);
    xml_set_object($this->parser, $this);
    xml_set_element_handler($this->parser, "startHandler", "endHandler");
    xml_set_character_data_handler($this->parser, "cdataHandler");
    xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, true);
  }

  function parse() {
    while ($data = fread($this->fp, 4096)){
      if (!xml_parse($this->parser,$data,feof($this->fp))){
        $error = xml_error_string(xml_get_error_code($this->parser));
        $line = xml_get_current_line_number($this->parser);
        throw new Exception("XML error: $error at line %s.");
      }
    }   
  }

  function __destructor() {
    fclose($this->fp);
    xml_parser_free($this->parser);
  }
}
?>
