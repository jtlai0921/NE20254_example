<?php
 include("Smarty.class.php");
 $tpl = new Smarty;
 $tpl->caching = true; // キャッシュを有効にします。
 $tpl->cache_lifetime = 3600; // キャッシュの有効時間(秒)
 $cid = md5($_SERVER['PHP_SELF'] . serialize($_POST) . serialize($_GET)); // キャッシュID
 if (!$tpl->is_cached("ex1.tpl", $cid)) { // 有効なキャッシュがない場合
    $tpl->assign("name","太郎"); // 変数を代入
 }
 $tpl->display("ex1.tpl", $cid); // テンプレートの内容を出力
?>
