<?php
$enc = "Big5";
$prefs = array("schema" => "B",
               "output-charset" => "Big5",
               "input-charset" => $enc,
               "line-break-chars" => "\n",
               "line-length" => 80);

$head = iconv_mime_encode("Subject","中文",$prefs); 
print $head; // 輸出: Subject: =?Big5?B?pKSk5Q==?=
print iconv_mime_decode($head, 0, "Big5"); // 輸出: Subject: 中文
?>
