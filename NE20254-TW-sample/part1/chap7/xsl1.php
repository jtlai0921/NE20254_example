<?php
 header('Content-Type: text/html; charset=Big5');
 $dom = domDocument::load("employee.xml");
 $xsl = domDocument::load("smpl1.xsl");
 $xs = new xsltProcessor;
 $xs->importStylesheet($xsl);  // ���w�˦���
 print $xs->transformToXml($dom);
?>

