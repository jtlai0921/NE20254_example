<?php
 require_once("Smarty.class.php");
 $tpl = new Smarty();
 $tpl->assign("sid",101);
 $tpl->assign("opts",array(100=>"¹a¤ì",101=>"¦õÃÃ",102=>"¤ì§ø"));
 $tpl->display("ex5.tpl");
?>
