<?php
$to = array("name"=>"�a��ӭ�", "email"=>"taro@example.com"); // ���H��
$from = array("name"=>"�޲z��", "email"=>"admin@example.com"); // �e�H��
// ���Y�H MIME �s�X
$from_head = mb_encode_mimeheader($from['name']) . " <{$from['email']}>";
$to_head = mb_encode_mimeheader($to['name']) . " <{$to['email']}>";
$extra = "From: $from_head\r\n"
       . "Reply-To: webmaster@example.com\r\n"
       . "X-Mailer: PHP-". phpversion();
$subject = "�q��"; // �D���۰ʽs�X
$body = "�z�n�A{$to['name']}���͡C"; // ����
mb_send_mail($to_head, $subject, $body, $extra); // �e�X Mail
?>
