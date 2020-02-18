<?php
 require_once("Smarty.class.php");
 $tpl = new Smarty();
 $tpl->assign("cid",array(100,101,102));
 $tpl->assign("name",array("ÎëÌÚ","»³ÅÄ","º´Æ£"));
 $tpl->display("ex4.tpl");
?>
