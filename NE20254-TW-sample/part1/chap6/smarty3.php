<?php
 include("Smarty.class.php");
 $tpl = new Smarty;
 $tpl->caching = true; // �Ұʧ֨��\��
 $tpl->cache_lifetime = 3600; // �֨������Įɶ�(��)
 $cid = md5($_SERVER['PHP_SELF'] . serialize($_POST) . serialize($_GET)); // �֨�ID
 if (!$tpl->is_cached("ex1.tpl", $cid)) { // �S�����Ī��֨���
    $tpl->assign("name","�ӭ�"); // �N�J�ܼ�
 }
 $tpl->display("ex1.tpl", $cid); // ��X�˪O�����e
?>
