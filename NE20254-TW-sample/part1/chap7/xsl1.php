<?php
 header('Content-Type: text/html; charset=Big5');
 $dom = domDocument::load("employee.xml");
 $xsl = domDocument::load("smpl1.xsl");
 $xs = new xsltProcessor;
 $xs->importStylesheet($xsl);  // 指定樣式表
 print $xs->transformToXml($dom);
?>

