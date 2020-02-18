<html><head http-equiv="Content-Type" content="text/html; charset=utf-8" /><body><?php
 $code_tbl = array('EUC-TW', 'BIG5', 'UTF-8');
 $detect_tbl = array('ASCII', 'EUC-TW', 'BIG5', 'UTF-8');

 mb_http_output("pass"); // 不進行輸出碼轉換
 $org_code = 'UTF-8'; // Script的字元碼

 $str = isset($_POST['str']) ? $_POST['str'] : "測試用文字"; // 輸入值初始化

 print <<<EOS
<form method="POST" action="{$_SERVER['PHP_SELF']}">
 <input type="text" name="str" value="$str"/>
 <input type="submit"/>
</form>
<table border="1">
<tr><th>字元碼</th><th>變換的一致性</th><th>檢測出的碼</th></tr>
EOS;
 foreach ($code_tbl as $code) {
   $dst = mb_convert_encoding($str, $code, $org_code);
   $code_estim = mb_detect_encoding($dst, $detect_tbl); // 檢測字元碼
   $str_dst = mb_convert_encoding($dst, $org_code, $code_estim);
   $judge = strcmp($str, $str_dst) ? "不一致" : "一致"; // 和原字串做比較
   print "<tr><td>$code</td><td>$judge</td><td>$code_estim</td></tr>";
 }
?></table>
</body></html>
