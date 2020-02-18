<?php
 $rss = domDocument::load('phpnews.rdf');

 if (preg_match("/DoCoMo/", $_SERVER['HTTP_USER_AGENT'])) {
   $xsltfile = 'rss-imode.xsl';
 } else {
   $xsltfile = 'rss-mozilla.xsl';
 }

 $xsl = domDocument::load($xsltfile);
 $xs = new xsltProcessor;
 $xs->importStylesheet($xsl);
 print $xs->transformToXml($rss);
?>
