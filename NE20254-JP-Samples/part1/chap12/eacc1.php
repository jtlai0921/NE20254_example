<?php
eaccelerator_cache_page($_SERVER['PHP_SELF'].serialize($_REQUEST), 30);
// �ʲ�����ƥ��
echo time()."<br />";
echo 'If-None-Match: '.$_SERVER['HTTP_IF_NONE_MATCH'];
?>