<?php
 include("Smarty.class.php");
 $tpl = new Smarty;
 $tpl->caching = true; // ����å����ͭ���ˤ��ޤ���
 $tpl->cache_lifetime = 3600; // ����å����ͭ������(��)
 $cid = md5($_SERVER['PHP_SELF'] . serialize($_POST) . serialize($_GET)); // ����å���ID
 if (!$tpl->is_cached("ex1.tpl", $cid)) { // ͭ���ʥ���å��夬�ʤ����
    $tpl->assign("name","��Ϻ"); // �ѿ�������
 }
 $tpl->display("ex1.tpl", $cid); // �ƥ�ץ졼�Ȥ����Ƥ����
?>
