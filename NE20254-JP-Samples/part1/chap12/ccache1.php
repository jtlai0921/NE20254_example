<?php
require_once('cachelib.php');
pzcache_header(30); // �֥饦������å��幹��Ƚ��
// ����ƥ�Ľ��ϳ���
print "<html><body>";
print "���ߤλ���::".time()."<br />";
print "Accept-Encoding::".$_SERVER['HTTP_ACCEPT_ENCODING']."<br />";
phpinfo();
// ����ƥ�Ľ��Ͻ�λ
?>
