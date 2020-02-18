<html><body><?php
 $code_tbl = array('SJIS','ISO-2022-JP','UTF-8','eucJP-win','SJIS-win');
 $detect_tbl = array('ASCII','ISO-2022-JP','UTF-8','EUC-JP','SJIS');

 mb_http_output("pass"); // 出力コード変換は行わない
 $org_code = get_cfg_var('mbstring.script_encoding'); // スクリプトの文字コード

 $str = isset($_POST['str']) ? $_POST['str'] : "試験用文字"; // 入力初期化

 print <<<EOS
<form method="POST" action="{$_SERVER['PHP_SELF']}">
 <input type="text" name="str" value="$str"/>
 <input type="submit"/>
</form>
<table border="1">
<tr><th>文字コード</th><th>変換の一致</th><th>検出コード</th></tr>
EOS;

 foreach ($code_tbl as $code) {
   $dst = mb_convert_encoding($str, $code, $org_code);
   $code_estim = mb_detect_encoding($dst, $detect_tbl); // 文字コード検出
   $str_dst = mb_convert_encoding($dst, $org_code, $code_estim);
   $judge = strcmp($str, $str_dst) ? "不一致" : "一致"; // 元の文字列と比較
   print "<tr><td>$code</td><td>$judge</td><td>$code_estim</td></tr>";
 }
?></table>
</body></html>
