<?php
/*
 * ¡¦â£¥·¡¦ö¦¥Û¥Á€€¥æ
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br>\n";};

if (! function_exists('mb_send_mail') ) { return; };
// ¡¼¥¯¥¿è
$TO = "root@localhost";

// ¥­þÎ¥»
$Subj = "[NewGuest $GuestTime] by $GuestEmail";

// ¡¦â£¥·¡¦ö§¥£¡£¥·¡¦¥¯¡¦¥¡¡¦€€¥Í
$mailer = "php-" . phpversion() . "/mb_send_mail";

// ¡¦¥ê¡¦¥Æ¡¦¥¿¡£¥·
$header = "From: $GuestEmail\n";
$header .= "Return-Path: $GuestEmail\n";
$header .= "Content-Type: text/plain; charset=ISO-2022-JP\n";
$header .= "Content-Transfer-Encoding: 7bit\n";
$header .= "X-Mailer: $mailer";

// ¥Ò¥ï¥Ï¥¯
$GuestDate = Date("Y¥Ì¥Ãm¥­ûÅ¥Ëü(D) h:ia",$GuestTime);
$body = "$GuestDate¡£¡Ö\n";
$body .= "$GuestName <$GuestEmail>¥Ø¥Ø¡¢¥Û¡¢¥¨¥ª¥å¥³¥ï¡¢¥Ì¡¢¥±¡£¡×\n";
$body .= "--\n";
$body .= "$GuestComment\n";
$body .= "--\n¡¼¥Ï¥»é½n";
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

// ¥Á€€¥ç
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
