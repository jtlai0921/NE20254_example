<?php
 require("Smarty.class.php");
 $tpl = new Smarty;
 $tpl->assign("title","テンプレートの例1");
 $tpl->assign("name","太郎");
 $tpl->display("ex1.tpl");
?>
