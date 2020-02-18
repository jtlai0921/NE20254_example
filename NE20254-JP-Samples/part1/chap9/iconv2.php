<?php
$enc = "SJIS";
$prefs = array("schema" => "B",
               "output-charset" => "ISO-2022-JP",
               "input-charset" => $enc,
               "line-break-chars" => "\n",
               "line-length" => 80);

$head = iconv_mime_encode("Subject","���ܸ�",$prefs); 
print $head; // ����: Subject: =?ISO-2022-JP?B?GyRCRnxLXDhsGyhC?=
print iconv_mime_decode($head); // ����: Subject: ���ܸ�
?>
