<?php
 require_once("Smarty.class.php");
 $tpl = new Smarty();
 $tpl->assign("sid",101);
 $tpl->assign("opts",array(100=>"����",101=>"��ƣ",102=>"��¼"));
 $tpl->display("ex5.tpl");
?>
