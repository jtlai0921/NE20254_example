<?php
$dom = domDocument::load('phpnews.rdf');
$xp = new domXPath($dom);
$xp->registerNamespace('rdf','http://www.w3.org/1999/02/22-rdf-syntax-ns#');
$xp->registerNamespace('rss','http://purl.org/rss/1.0/');
$titles = $xp->query("//rss:item/rss:title/text()");
foreach($titles as $title) {
  print $title->nodeValue . "\n";
}
?>
