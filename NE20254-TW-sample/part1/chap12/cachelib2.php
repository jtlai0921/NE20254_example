<?php
define('CACHE_PATH','/tmp/'); // 儲存快取的路徑

function pzcache_gz_content($gzcontent, $crc, $len) {
  global $enc;
  $dat = "\x1f\x8b\x08\x00\x00\x00\x00\x00";
  $dat .= substr($gzcontent, 0, strlen($gzcontent)- 4);
  $dat .= pack('VV',$crc, $len);
  return $dat;
}

function ob_cache_handler($content, $status) {
  if (($status & PHP_OUTPUT_HANDLER_START) != 0 &&
    ($status & PHP_OUTPUT_HANDLER_END) != 0) {
    $cache['ctime'] = time();
    $cache['crc'] = crc32($content);
    $cache['len'] = strlen($content);
    $cache['content'] = gzcompress($content);

    $fp = fopen($GLOBALS['file'],'w');
    fwrite($fp, serialize($cache));
    fclose($fp);
  }
  return $content;
}

function pzcache_read_cache() {
  if (!file_exists($GLOBALS['file'])) {
    return false;
  }
  $data = file_get_contents($GLOBALS['file']);
  if (!$data) {
    return false;
  }
  return unserialize($data);
}

function pzcache_header($expire = 300) {
  
  $key = 'cache'.md5($_SERVER['PHP_SELF'].serialize($_REQUEST));
  $ctime = time();
  list($mkey,$atime) = explode("-",$_SERVER['HTTP_IF_NONE_MATCH']);  
  if (isset($atime) && $mkey == $key && $ctime-$atime<$expire) {
    header('HTTP/1.0 304');
    header('Status: 304 Not Modified');
    exit;
  } else {
    header("ETag: $key-$ctime");
  } 

  if (strstr($_SERVER['HTTP_ACCEPT_ENCODING'],'gzip')) {
    $gz_compress = true; 
  } else {
    $gz_compress = false;
  }

  $GLOBALS['file'] = CACHE_PATH . $key; // 快取檔名
  $cache = pzcache_read_cache(); // 讀入快取

  if ($cache && $ctime-$cache['ctime']<$expire) {  // 有效的快取存在時
    if ($gz_compress) { // 支援內容壓縮的情形
      header('Content-Encoding: gzip'); // 以 gzup 壓縮來傳送
      header('Vary: Accept-Encoding');  // 對 Proxy 指示 Accept-Encoding 傳送確認
      echo pzcache_gz_content($cache['content'],$cache['crc'],$cache['len']);
    } else {
      echo gzuncompress($cache['content']);
    }
    exit;
  } else {
    ob_start('ob_cache_handler');
  }
}
?>
