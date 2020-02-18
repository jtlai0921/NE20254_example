<?php
 $dom = domDocument::load('employee.xml');
 $xsl = domDocument::load('smpl1.xsl');

 $xp = new domxpath($xsl);
 $result = $xp->query("/xsl:stylesheet/xsl:output/@encoding");
 if ($result->length != 1) {
   die("encoding is not found.");
 }
 $result->item(0)->value = "Shift_JIS"; // 文字コードをシフトJISに変更

 $xs = new xsltProcessor;
 $xs->importStylesheet($xsl);
 print $xs->transformToXml($dom);
?>
