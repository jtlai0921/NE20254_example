<?php
 require_once("Smarty.class.php");
 $tpl = new Smarty();
 $tpl->assign("cid",array(100,101,102));
 $tpl->assign("name",array("¹a¤ì","¤s¥Ð","¦õÃÃ"));
 $tpl->display("ex4.tpl");
?>
