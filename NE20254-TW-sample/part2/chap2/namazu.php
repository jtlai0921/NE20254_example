<html><body>
<?php // Namazu�ˤ����ʸ����
if (!isset($_POST['query'])){ // ����ʸ���󤬤ʤ����ϥե������ɽ��
?>
  <H1>Namazu�ˤ����ʸ����</H1>
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
   ����ʸ����: <input type="text" name="query" size="20" /><br />
   ��������ˡ: 
     <input type="radio" name="sort" value="score" checked />������
     <input type="radio" name="sort" value="date" />����
     <input type="radio" name="sort" value="subject" />��̾
   <input type="submit" value="����" />
  </form>
<?php
} else { // ��ʸ������¹�
?>
 <h1>Namazu�������</h1>
<?php
 $index = array("/usr/share/namazu/index/phpdoc");
 $nmz = nmz_open($index) or die("Couldn't open index.");
 switch ($_POST['sort']) {
 case 'score': $sort = 'score'; break;
 case 'date': $sort = 'date'; break;
 case 'subject': $sort = 'field:{subject}'; break;
 default: $sort = 'score';
 }
 nmz_set_sortmethod($sort);
 $result = nmz_search($nmz,strip_tags($_POST['query'])) or die("Query failed.");
 
 $count = nmz_num_hits($result);
 if ($count>0){
   print "<strong> ��� $count ��ҥåȤ��ޤ�����</strong><p>\n";
   
   print "<dl>\n";
   
   for ($i=0;$i<$count;$i++){
     $cnt = $i+1;
     $score = nmz_result_score($result,$i); // ����������
     $date = date('Y/m/d',nmz_result_date($result,$i)); // ��������
     $uri = nmz_result_field($result,$i,"uri"); // URI
     $summary = htmlspecialchars(nmz_result_field($result,$i,"summary")); // ���ޥ�
     $subject = htmlspecialchars(nmz_result_field($result,$i,"subject")); // ��̾
     
     print <<<EOS
       <dt>$cnt. <a href="file://$uri">$uri</a>
       <dd>����: $date
       <dd>������: $score
       <dd>��̾: $subject
       <dd>����: $summary
EOS;
   }
   print "</dl>";
   nmz_free_result($result); // ��������ݻ��ѥ꥽���������
   nmz_close($nmz); // Namazu�ϥ�ɥ���Ĥ���
   
 } else {
   print "�ҥåȤ��ޤ���Ǥ�����";
 }
} 
?>
</body></html>
