<?php
$enc = "Big5";
$prefs = array("schema" => "B",
               "output-charset" => "Big5",
               "input-charset" => $enc,
               "line-break-chars" => "\n",
               "line-length" => 80);

$head = iconv_mime_encode("Subject","����",$prefs); 
print $head; // ��X: Subject: =?Big5?B?pKSk5Q==?=
print iconv_mime_decode($head, 0, "Big5"); // ��X: Subject: ����
?>
