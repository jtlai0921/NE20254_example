<?php
 $root = simplexml_load_file('simple1.xml');
 echo $root->person[0] ."\n";
 echo $root->person[0]['id'] ."\n";
 $root->person[1] = '�    �    ';
 $root->person[2] = '  ��  次�  ';
 $root->person[2]['id'] = 'a3';
 print $root->asXML();
?>