<?php
 include("Smarty.class.php");
 $tpl = new Smarty;
 $tpl->caching = true; // 啟動快取功能
 $tpl->cache_lifetime = 3600; // 快取的有效時間(秒)
 $cid = md5($_SERVER['PHP_SELF'] . serialize($_POST) . serialize($_GET)); // 快取ID
 if (!$tpl->is_cached("ex1.tpl", $cid)) { // 沒有有效的快取時
    $tpl->assign("name","太郎"); // 代入變數
 }
 $tpl->display("ex1.tpl", $cid); // 輸出樣板的內容
?>
