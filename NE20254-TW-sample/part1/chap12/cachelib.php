<?php
function pzcache_header($expire = 300) {
  $key = 'cache'.md5($_SERVER['PHP_SELF'].serialize($_REQUEST));
  $ctime = time(); // 存取時間
  list($mkey,$atime) = explode("-",$_SERVER['HTTP_IF_NONE_MATCH']);  
  if (isset($atime) && $mkey == $key && $ctime-$atime<$expire) {
    header('HTTP/1.0 304');
    header('Status: 304 Not Modified');
    exit;
  } else {
    header("ETag: $key-$ctime");
  } 
}
?>
