<?php
 require_once("Smarty.class.php");
 $tpl = new Smarty();
 $tpl->assign("name","太郎");
 $tpl->assign("address","東京都千代田區");
 $tpl->display("ex2.tpl");
?>
