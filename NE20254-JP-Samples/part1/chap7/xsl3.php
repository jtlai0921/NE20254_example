<?php
 $dom = domDocument::load('employee.xml');
 $xsl = domDocument::load('smpl2.xsl');

 $xs = new xsltProcessor;
 $xs->importStylesheet($xsl);
 $s = mb_convert_encoding("メンバーリスト", "utf-8", "euc-jp");
 $xs->setParameter(null, "title", $s);
 print $xs->transformToXml($dom);
?>
