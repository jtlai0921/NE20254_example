<?php
/*
 * 傳送郵件
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br>\n";};

if (! function_exists('mb_send_mail') ) { return; };
// 收件者
$TO = "root@localhost";

// 主旨
$Subj = "[NewGuest $GuestTime] by $GuestEmail";

// 郵件傳送方式
$mailer = "php-" . phpversion() . "/mb_send_mail";

// 標頭
$header = "From: $GuestEmail\n";
$header .= "Return-Path: $GuestEmail\n";
$header .= "Content-Type: text/plain; charset=ISO-2022-JP\n";
$header .= "Content-Transfer-Encoding: 7bit\n";
$header .= "X-Mailer: $mailer";

// 本文
$GuestDate = Date("Y年m月d日(D) h:ia",$GuestTime);
$body = "$GuestDate、\n";
$body .= "$GuestName <$GuestEmail> 先生/小姐的留言內容。\n";
$body .= "--\n";
$body .= "$GuestComment\n";
$body .= "--\n以上\n";
$body .= "--------------------------------";
$body .= "--------------------------------\n";
$body .= "[Client Informations]\n";
$body .= "    HTTP User Agent:\t{$_SERVER['HTTP_USER_AGENT']}\n";
$body .= "    Remote Host:\t{$_SERVER['REMOTE_HOST']}\n";
$body .= "    Remote Addr:\t{$_SERVER['REMOTE_ADDR']}\n";
$body .= "    Request URI:\t{$_SERVER['REQUEST_URI']}\n";
$body .= "--------------------------------";
$body .= "--------------------------------\n";
$body .= "[Server Informations]\n";
$body .= "    Server Name:\t{$_SERVER['SERVER_NAME']}\n";
$body .= "    HTTP Host:\t{$_SERVER['HTTP_HOST']}\n";
$body .= "    Script FileName:\t{$_SERVER['SCRIPT_FILENAME']}\n";
$body .= "--------------------------------";
$body .= "--------------------------------\n";

// 傳送
mb_send_mail($TO, $Subj, $body, $header);

if($DEBUG){
  echo "<blockquote><pre>\n";
  echo "TO: ".htmlspecialchars($TO)."\n";
  echo htmlspecialchars($header)."\n";
  echo "Subject: ".htmlspecialchars($Subj)."\n";
  echo htmlspecialchars($body)."\n";
  echo "</pre></blockquote>\n";
}
?>
