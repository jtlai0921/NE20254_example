<?php
 header('Content-Type: text/html; charset=big5');
 $dom = domDocument::load('employee.xml');
 $xsl = domDocument::load('smpl2.xsl');

 $xs = new xsltProcessor;
 $xs->importStylesheet($xsl);
 $s = mb_convert_encoding("成員清單", "utf-8", "big5");
 $xs->setParameter(null, "title", $s);
 print $xs->transformToXml($dom);
?>
