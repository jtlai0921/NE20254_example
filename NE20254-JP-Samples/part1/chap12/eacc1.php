<?php
eaccelerator_cache_page($_SERVER['PHP_SELF'].serialize($_REQUEST), 30);
// 以下コンテンツ
echo time()."<br />";
echo 'If-None-Match: '.$_SERVER['HTTP_IF_NONE_MATCH'];
?>