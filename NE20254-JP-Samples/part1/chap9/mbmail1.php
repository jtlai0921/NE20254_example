<?php
$to = array("name"=>"鈴木たろう", "email"=>"taro@example.com"); // 宛先
$from = array("name"=>"管理者", "email"=>"admin@example.com"); // 送信者
// ヘッダをMIMEエンコード
$from_head = mb_encode_mimeheader($from['name']) . " <{$from['email']}>";
$to_head = mb_encode_mimeheader($to['name']) . " <{$to['email']}>";
$extra = "From: $from_head\r\n"
       . "Reply-To: webmaster@example.com\r\n"
       . "X-Mailer: PHP-". phpversion();
$subject = "お知らせ"; // 件名は自動的にエンコードされます
$body = "こんにちは、{$to['name']}さん。"; // 本文
mb_send_mail($to_head, $subject, $body, $extra); // メール送信
?>
