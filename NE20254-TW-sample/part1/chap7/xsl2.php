<?php
 header('Content-Type: text/html; charset=utf-8');
 $dom = domDocument::load('employee.xml');
 $xsl = domDocument::load('smpl1.xsl');

 $xp = new domxpath($xsl);
 $result = $xp->query("/xsl:stylesheet/xsl:output/@encoding");
 if ($result->length != 1) {
   die("encoding is not found.");
 }
 $result->item(0)->value = "UTF-8"; // �N��X�r���ର UTF-8

 $xs = new xsltProcessor;
 $xs->importStylesheet($xsl);
 print $xs->transformToXml($dom);
?>
