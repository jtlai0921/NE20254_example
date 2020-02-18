<html><body>
<?php
require_once('XML_RSS.php');

$rss = new XML_RSS('phpnews.rdf');
try {
  $rss->parse();
} catch (Exception $e) {
  print $e->getMessage();
}

print "<a href=\"{$rss->channel['LINK']}\">{$rss->channel['TITLE']}</a>\n";
print '<table border="1">';
foreach ($rss->items as $item){
  print <<<EOS
<tr><td><a href="{$item['LINK']}">{$item['TITLE']}({$item['DC:DATE']})</a>
  <br />{$item['DESCRIPTION']}</tr>
EOS;
}
print '</table>';
?>
</body></html>
