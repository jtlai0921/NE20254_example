<?php
 $dom = domDocument::load("employee.xml");
 $xsl = domDocument::load("smpl1.xsl");
 $xs = new xsltProcessor;
 $xs->importStylesheet($xsl);  // �������륷���Ȥ����
 print $xs->transformToXml($dom);
?>

