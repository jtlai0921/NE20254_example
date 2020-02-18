<?php
 require_once("Smarty.class.php");
 $tpl = new Smarty();
 $tpl->assign("name","ÂÀÏº");
 $tpl->assign("address","ÅìµþÅÔÀéÂåÅÄ¶è");
 $tpl->display("ex2.tpl");
?>
