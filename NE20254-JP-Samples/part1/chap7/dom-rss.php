<html><body>
<?php
$dom = new domDocument();
$dom->load('phpnews.rdf');
$root = $dom->documentElement;

print '<table border="1">';
foreach($root->childNodes as $elems) {
  if ($elems->nodeType == XML_ELEMENT_NODE &&
      $elems->nodeName == 'item') {
    $d = array();
    foreach ($elems->childNodes as $item) {
      if ($item->nodeType == XML_ELEMENT_NODE) {
        $child = $item->firstChild;
        if ($child->nodeType == XML_TEXT_NODE) {
          $d[$item->nodeName] = $child->nodeValue;
        }
      }
    }
    print <<<EOS
<tr><td><a href="{$d['link']}">{$d['title']}({$d['dc:date']})</a>
  <br />{$d['description']}</tr>
EOS;
  }
}
?>
</table>
</body></html>
