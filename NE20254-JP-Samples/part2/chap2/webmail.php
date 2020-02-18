<?php
require_once 'MailApp.php';
session_start();

$mail = new MailApp();
$uri = $mail->getLogin();

$ret = $mail->connect($uri);
if (PEAR::isError($ret)) {
  echo $mail->alerts(),"<br />";
  echo $mail->errors(),"<br />";
  die("connection problem with POP3 server ");
}
if (isset($_GET['mid'])) { // ��å�����ɽ��
  $pid = isset($_GET['pid']) ? $_GET['pid'] : null;
  $mail->showMessage((int)$_GET['mid'], $pid);
} else if (isset($_GET['delete'])) { // ��å��������
  $mail->deleteMessage((int)$_GET['delete']);
} else if (isset($_GET['send'])) { // ��å���������
  if (!isset($_POST['to']) || !isset($_POST['from']) || !isset($_POST['subject'])) {
    $mail->messageCreate();
  } else {
    $mail->messageSend();
  }
} else { // ����ɽ��
  $mail->showList();
}

$mail->close();
?>
</body></html>
