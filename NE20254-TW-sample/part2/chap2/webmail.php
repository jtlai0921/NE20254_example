<?php
require_once 'MailApp.php';
session_start();

header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding("UTF-8");

$mail = new MailApp();
$uri = $mail->getLogin();

$ret = $mail->connect($uri);
if (PEAR::isError($ret)) {
  echo $mail->alerts(),"<br />";
  echo $mail->errors(),"<br />";
  die("connection problem with POP3 server ");
}
if (isset($_GET['mid'])) { // 顯示郵件
  $pid = isset($_GET['pid']) ? $_GET['pid'] : null;
  $mail->showMessage((int)$_GET['mid'], $pid);
} else if (isset($_GET['delete'])) { // 刪除郵件
  $mail->deleteMessage((int)$_GET['delete']);
} else if (isset($_GET['send'])) { // 建立郵件
  if (!isset($_POST['to']) || !isset($_POST['from']) || !isset($_POST['subject'])) {
    $mail->messageCreate();
  } else {
    $mail->messageSend();
  }
} else { // 顯示郵件清單
  $mail->showList();
}

$mail->close();
?>
</body></html>
