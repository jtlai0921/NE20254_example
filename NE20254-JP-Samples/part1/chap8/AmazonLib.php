<?php
class AmazonRequest {
  public $Keywords;
  public $SearchIndex;
  function __construct($key, $index = 'Books') {
    $this->Keywords = $key;
    $this->SearchIndex = $index;
  }
}

class AmazonResult {
  function showItemSearch($items) {
    print "<ul>";
    foreach($items as $item) {
      $attrs = $item->ItemAttributes;
      print "<li><a href=\"{$item->DetailPageURL}\">{$attrs->Title}</a><br/>";
      if (is_array($attrs->Author) || is_object($attrs->Author)) {
        foreach($attrs->Author as $author) {
          print "$author,";
        }
      } else {
        print $attrs->Author .",";
      }
      print "ASIN:".$item->ASIN."\n";
    }
    print "</ul>";
  }
}
?>
