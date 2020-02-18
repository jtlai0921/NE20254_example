<?php
 function show($time) {
  return date('Y/m/d H:i:s', $time[0]->value);
 }

 $dom = domDocument::load('sample.xml');
 $xsl = domDocument::load('smpl3.xsl');

 $xs = new xsltProcessor;
 $xs->importStylesheet($xsl);
 $xs->registerPHPFunctions();
 print $xs->transformToXml($dom);
?>
