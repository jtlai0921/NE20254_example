<html><body>
<?php // Namazuによる全文検索
if (!isset($_POST['query'])){ // 検索文字列がない場合はフォームを表示
?>
  <H1>Namazuによる全文検索</H1>
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
   検索文字列: <input type="text" name="query" size="20" /><br />
   ソート方法: 
     <input type="radio" name="sort" value="score" checked />スコア
     <input type="radio" name="sort" value="date" />日付
     <input type="radio" name="sort" value="subject" />題名
   <input type="submit" value="検索" />
  </form>
<?php
} else { // 全文検索を実行
?>
 <h1>Namazu検索結果</h1>
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
   print "<strong> 合計 $count 回ヒットしました。</strong><p>\n";
   
   print "<dl>\n";
   
   for ($i=0;$i<$count;$i++){
     $cnt = $i+1;
     $score = nmz_result_score($result,$i); // スコア情報
     $date = date('Y/m/d',nmz_result_date($result,$i)); // 作成日付
     $uri = nmz_result_field($result,$i,"uri"); // URI
     $summary = htmlspecialchars(nmz_result_field($result,$i,"summary")); // サマリ
     $subject = htmlspecialchars(nmz_result_field($result,$i,"subject")); // 題名
     
     print <<<EOS
       <dt>$cnt. <a href="file://$uri">$uri</a>
       <dd>日付: $date
       <dd>スコア: $score
       <dd>題名: $subject
       <dd>概要: $summary
EOS;
   }
   print "</dl>";
   nmz_free_result($result); // 検索結果保持用リソースを解放
   nmz_close($nmz); // Namazuハンドラを閉じる
   
 } else {
   print "ヒットしませんでした。";
 }
} 
?>
</body></html>
