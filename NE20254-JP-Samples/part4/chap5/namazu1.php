<?php
 $query='PHP5';
 $index = '/usr/share/namazu/index/phpdoc';
 $id = nmz_open($index) or die('namazu index open error');
 $result = nmz_search($id, $query) or die('query failed'); // ������¹�
 // ������̤����
 $subject = nmz_fetch_field($result, "subject");
 $uri = nmz_fetch_field($result, "uri");
 $score = nmz_fetch_score($result);
 for ($i=0; $i<nmz_num_hits($result); $i++) { // ������̤�ɽ��
   printf("%d %s %s\n",$score[$i],$subject[$i],$uri[$i]);
 }
?>
