<?php
//   Original version was found in example programs of
// PHP/FI-2.0 by Rasmus Lerdorf <rasmus@lerdorf.on.ca> in 1997.
//
// Thanks to Thomas Bullinger (rootmail@btoy1.rochester.NY.US) for writing
// the first sample PHP Script Mail form.
// 						Rasmus Lerdorf
//
//  History:
//      2002-04-24 JuK modification for register_globals=Off.
//	2002-04-21 JuK	mail subject encoding
//	2002-04-03 JuK	PHP-4.1.2(register_globals=off)
//	2001-06-26 JuK	PHP-4.0.6(with mbstring)
//	2000-07-19 JuK	port to PHP4 with jstring module.
//	1999-10-12 JuK	use mail() instead of piping to sendmail -t
//	1999-06-06 JuK	convert for PHP3
//	1997-05-21 JuK	modified to 日本語版
//
// Mail results to this address:
	$TO = "root@localhost"; 
//
// This is the mail program we will use - check path on target system
//	$MP = "/usr/sbin/sendmail -t";

  if(!extension_loaded('mbstring')){
        if(!dl('mbstring.so')){
                echo 'error dynamic loading mbstring.so!';
                exit;
        }
  }

?>
<html>
<head><title>E-Mail to Web Master</title></head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=x-euc-jp">
<body BGCOLOR="#FFFFFF" TEXT="#000000" LINK="#0750c0" VLINK="#105020">
<center>
<img src="mailform.jpg" border="0" width="200" alt="Mail Form" align="TEXTLEFT">
</center>

<hr size=1>

<blockquote>
<h2>担当者へのメール</h2>
</blockquote>
<hr width="90%" size=3>

<?
 // ヘッダーがセットされていれば、
 if(isset($_GET['HEADER'])):
	mb_send_mail($TO, 
		"[mailform]".mb_encode_mimeheader($_GET['SUBJE']),
		mb_convert_encoding($_GET['BODY'], 'iso-2022-jp'),
		$_GET['HEADER']);
?>
	<blockquote>
	<? echo $_GET['HEADER']."<br>"; ?>
	メッセージを送りました!!<br>
	</blockquote>
	<hr width="90%" size=3>
	<?include("gbtrailer.php");?>
	</body></html>
<?
	exit;
 endif;

 // メッセージ本体がなければ、
 if( empty($_GET['CHECK_BODY']) ):
?>
    <blockquote>
	ページについてのご意見やご要望は、
	下記のフォームから担当者宛に
	メールをお送り下さい。<br>

	<form action="<?echo $_SERVER['PHP_SELF']?>" method="GET">
	<table><tr><td>
	お名前</td><td><input type="TEXT" name="NAME" value="<?echo $_GET['NAME']?>" size=30><br>
	</td></tr><tr><td>
	メール</td><td><input type="TEXT" name="FROM_ADDR" value="<?echo $_GET['FROM_ADDR']?>" size=40><br>
	</td></tr><tr><td>
	表題</td><td><input type="TEXT" name="EMAIL_SUBJ" value="<?echo $_GET['EMAIL_SUBJ']?>" size=60><br>
	</td></tr></table>
	ご意見<br><textarea name="CHECK_BODY" rows=4 cols=70></textarea><BR>
	<center>
	<input type="SUBMIT" value=" 内容確認 ">
	</center>
	</form>
    </blockquote>

<? else: ?>
    <blockquote>
	送信しようとしている内容は以下の通りです:<br>

	<center><table border=1><tr><td>
	<?
	  echo "To: $TO<br>";
	  echo "From: ".$_GET['FROM_ADDR']."<br>";
	  echo "Subject: [mailform] ".$_GET['EMAIL_SUBJ']."<br>";
	  echo "Reply-to: ".$_GET['FROM_ADDR']."<br>";
	  echo "X-Mailer: PHP-".phpversion()."<br><br>";
	  echo "<pre>".$_GET['CHECK_BODY']."</pre>";

	  $header = "From: ".$_GET['FROM_ADDR'];
	  $header .= "\nContent-Type: text/plain; charset=ISO-2022-JP";
	  $header .= "\nContent-Transfer-Encoding: 7bit";
	  $header .= "\n";
	  $header .= "\nX-Mailer: PHP-".phpversion();
	  //echo "$header<br>";
	?>
	</td></tr></table></center>
	<center>
	<form action="<?echo $_SERVER['PHP_SELF']?>" method="GET">
	<input type="hidden" name="HEADER" value="<?echo $header?>">
	<input type="hidden" name="SUBJE" value="<?echo $_GET['EMAIL_SUBJ']?>"><br>
	<input type="hidden" name="BODY" value="<?echo $_GET['CHECK_BODY']?>">
	<input type="SUBMIT" value=" 送信します ">
	</form>
	</center>
    </blockquote>

<? endif ?>
<hr width="90%" size=3>
<? include("gbtrailer.php"); ?>
</body>
</html>
