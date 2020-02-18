<html><body>
<?php
define('DC','http://purl.org/dc/elements/1.1/');
$rss = simplexml_load_file('phpnews.rdf');
print "<a href=\"{$rss->channel->link}\">{$rss->channel->title}</a>\n";
print '<table border="1">';
foreach ($rss->item as $item){
  $date = $item->children(DC)->date;
  print <<<EOS
<tr><td><a href="{$item->link}">{$item->title}($date)</a>
  <br />{$item->description}</tr>
EOS;
}
print '</table>';
?>
</body></html>
