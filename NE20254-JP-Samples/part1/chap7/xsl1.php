<?php
 $dom = domDocument::load("employee.xml");
 $xsl = domDocument::load("smpl1.xsl");
 $xs = new xsltProcessor;
 $xs->importStylesheet($xsl);  // スタイルシートを指定
 print $xs->transformToXml($dom);
?>

