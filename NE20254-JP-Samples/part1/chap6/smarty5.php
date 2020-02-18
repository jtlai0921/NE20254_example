<?php
 require_once("Smarty.class.php");
 $tpl = new Smarty();
 $tpl->assign("sid",101);
 $tpl->assign("opts",array(100=>"ÎëÌÚ",101=>"º´Æ£",102=>"ÌÚÂ¼"));
 $tpl->display("ex5.tpl");
?>
