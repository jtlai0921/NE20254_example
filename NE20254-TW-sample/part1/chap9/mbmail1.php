<?php
$to = array("name"=>"鈴木太郎", "email"=>"taro@example.com"); // 收信者
$from = array("name"=>"管理者", "email"=>"admin@example.com"); // 送信者
// 標頭以 MIME 編碼
$from_head = mb_encode_mimeheader($from['name']) . " <{$from['email']}>";
$to_head = mb_encode_mimeheader($to['name']) . " <{$to['email']}>";
$extra = "From: $from_head\r\n"
       . "Reply-To: webmaster@example.com\r\n"
       . "X-Mailer: PHP-". phpversion();
$subject = "通知"; // 主旨自動編碼
$body = "您好，{$to['name']}先生。"; // 本文
mb_send_mail($to_head, $subject, $body, $extra); // 送出 Mail
?>
