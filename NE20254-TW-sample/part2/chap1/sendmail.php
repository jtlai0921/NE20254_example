<?
// 2001-06-26 JuK PHP-4.0.6(with mbstring)
// 2000-07-19 JuK port to PHP4 with jstring module.

  if(!extension_loaded('mbstring')){
        if(!dl('mbstring.so')){
                echo 'error';
                exit;
        }
  }

	$TO = "root@localhost"; 
	$MP = "nkf -j | /usr/sbin/sendmail -oi -t -oem -odb";

	$fd = popen($MP,"w");
	fputs($fd, "To: $TO\n");
	fputs($fd, "From: $GuestEmail\n");
	fputs($fd, "Subject: New Guest(<? echo $PHP_SELF ?>)\n");
	fputs($fd, "Reply-to: $GuestEmail\n");
	$ver = phpversion();
	fputs($fd, "X-Mailer: PHP $ver\n\n");

	$GuestDate = Date("Yǯm��d��(D) h:ia",$GuestTime);
	fputs($fd, "$GuestDate��\n");
	fputs($fd, "$GuestName ��");
	fputs($fd, "(Email: $GuestEmail) �����ܤ���ޤ�����\n");

	fputs($fd, "\n--\n");
	fputs($fd, $GuestComment);
	fputs($fd, "\n--\n\n�ʾ�\n");

	fputs($fd, "\n[Client Informations]\n");
	fputs($fd, "    HTTP User Agent:\t$HTTP_USER_AGENT\n");
	fputs($fd, "    Remote Host:\t$REMOTE_HOST\n");
	fputs($fd, "    Remote Address:\t$REMOTE_ADDR\n");
	fputs($fd, "    Request URI:\t$REQUEST_URI\n");

	fputs($fd, "\n[Server Informations]\n");
	fputs($fd, "    Server Name:\t$SERVER_NAME\n");
	fputs($fd, "    HTTP Host:\t$HTTP_HOST\n");
	fputs($fd, "    Script FileName:\t$SCRIPT_FILENAME\n");

	pclose($fd);

?>
