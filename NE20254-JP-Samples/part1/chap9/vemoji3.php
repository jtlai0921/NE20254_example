<?php
 $str = "\x1b\$G\x21\x0fabc"; // ��ʸ������ʸ����
 $regex = '/\x1b\$([E-G])([\x21-\x7a])+\x0f/e'; // ��ʸ���˥ޥå���������ɽ��
 echo preg_replace($regex, 'sprintf("<img src=\"%02X%02X.gif\">",
     ord("$1"),ord("$2"))', $str); // ��ʸ���򥤥᡼���������Ѵ����ƽ���
?>

