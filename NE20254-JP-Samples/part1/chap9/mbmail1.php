<?php
$to = array("name"=>"���ڤ���", "email"=>"taro@example.com"); // ����
$from = array("name"=>"������", "email"=>"admin@example.com"); // ������
// �إå���MIME���󥳡���
$from_head = mb_encode_mimeheader($from['name']) . " <{$from['email']}>";
$to_head = mb_encode_mimeheader($to['name']) . " <{$to['email']}>";
$extra = "From: $from_head\r\n"
       . "Reply-To: webmaster@example.com\r\n"
       . "X-Mailer: PHP-". phpversion();
$subject = "���Τ餻"; // ��̾�ϼ�ưŪ�˥��󥳡��ɤ���ޤ�
$body = "����ˤ��ϡ�{$to['name']}����"; // ��ʸ
mb_send_mail($to_head, $subject, $body, $extra); // �᡼������
?>
