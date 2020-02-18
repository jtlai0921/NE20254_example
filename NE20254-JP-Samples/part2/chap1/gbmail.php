<?php
/*
 * ��⣥������ۥ�����
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br>\n";};

if (! function_exists('mb_send_mail') ) { return; };
// �������
$TO = "root@localhost";

// ���Υ�
$Subj = "[NewGuest $GuestTime] by $GuestEmail";

// ��⣥�������������������������
$mailer = "php-" . phpversion() . "/mb_send_mail";

// ���ꡦ�ơ�������
$header = "From: $GuestEmail\n";
$header .= "Return-Path: $GuestEmail\n";
$header .= "Content-Type: text/plain; charset=ISO-2022-JP\n";
$header .= "Content-Transfer-Encoding: 7bit\n";
$header .= "X-Mailer: $mailer";

// �ҥ�ϥ�
$GuestDate = Date("Y�̥�m���ť��(D) h:ia",$GuestTime);
$body = "$GuestDate����\n";
$body .= "$GuestName <$GuestEmail>�إء��ۡ������女��̡�������\n";
$body .= "--\n";
$body .= "$GuestComment\n";
$body .= "--\n���ϥ��n";
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

// ������
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
