<?php
 require_once("Smarty.class.php");
 $tpl = new Smarty();
 $tpl->assign("sid",101);
 $tpl->assign("opts",array(100=>"�a��",101=>"����",102=>"���"));
 $tpl->display("ex5.tpl");
?>
