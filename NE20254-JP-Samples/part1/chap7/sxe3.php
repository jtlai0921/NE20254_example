<?php
 $root = simplexml_load_file('simple1.xml');
 $person = $root->xpath("/members/person[@id='a1']");
 print $person[0];
?>
