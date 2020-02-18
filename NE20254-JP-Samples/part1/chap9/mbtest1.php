<html><body><?php
 $code_tbl = array('SJIS','ISO-2022-JP','UTF-8','eucJP-win','SJIS-win');
 $detect_tbl = array('ASCII','ISO-2022-JP','UTF-8','EUC-JP','SJIS');

 mb_http_output("pass"); // ���ϥ������Ѵ��ϹԤ�ʤ�
 $org_code = get_cfg_var('mbstring.script_encoding'); // ������ץȤ�ʸ��������

 $str = isset($_POST['str']) ? $_POST['str'] : "���ʸ��"; // ���Ͻ����

 print <<<EOS
<form method="POST" action="{$_SERVER['PHP_SELF']}">
 <input type="text" name="str" value="$str"/>
 <input type="submit"/>
</form>
<table border="1">
<tr><th>ʸ��������</th><th>�Ѵ��ΰ���</th><th>���Х�����</th></tr>
EOS;

 foreach ($code_tbl as $code) {
   $dst = mb_convert_encoding($str, $code, $org_code);
   $code_estim = mb_detect_encoding($dst, $detect_tbl); // ʸ�������ɸ���
   $str_dst = mb_convert_encoding($dst, $org_code, $code_estim);
   $judge = strcmp($str, $str_dst) ? "�԰���" : "����"; // ����ʸ��������
   print "<tr><td>$code</td><td>$judge</td><td>$code_estim</td></tr>";
 }
?></table>
</body></html>
