<?php
require_once('Mail.php');
require_once 'Mail/IMAP.php';
require_once('Mail/mime.php');

class MailApp extends Mail_IMAP {
  public $text_charset = "utf-8";
  public $host = "sbt";

  function getLogin() {
    if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
      if (!isset($_POST['username']) || !isset($_POST['password'])) {
        echo <<<EOS
          <pre><form action="{$_SERVER['PHP_SELF']}" method="POST">
          使用者名稱:   <input type="text" name="username" />
          密碼: <input type="password" name="password" />
          <input type="submit" value="登入"/>
        </form></pre>
EOS;
        exit();
      }
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['password'] = $_POST['password'];
    }
    $uri = "pop3://{$_SESSION['username']}:{$_SESSION['password']}@{$this->host}/";
    return $uri;
  }

  function showHeader() {
    echo '<html><body>';
    echo "[<a href=\"{$_SERVER['PHP_SELF']}?send\">建立郵件</a>]";
  }

  function showFooter() {
    echo "<hr /><a href=\"{$_SERVER['PHP_SELF']}\">顯示郵件清單</a></body></html>";
  }

  function showList() {
    $this->showHeader();
    $msg_num = $this->messageCount();
    if ($msg_num == 0) {
      echo "沒有郵件";
      return;
    }
    echo <<<EOS
      <table border="1">
      <tr><th>主旨</th><th>寄件者</th><th>送信時間</th><th>大小</th><th></th></tr>
EOS;
    for ($id = 1; $id <= $msg_num; $id++) {
      $pid = $this->getDefaultPid($id);
      $h = $this->processHeaders($id, $pid);
      echo <<<EOS
<tr>
 <td><a href="{$_SERVER['PHP_SELF']}?mid=$id">{$h['subject']}</a></td>
 <td>{$h['from']}</td><td>{$h['date']}</td><td>{$h['size']}</td>
 <td><a href="{$_SERVER['PHP_SELF']}?delete=$id">刪除</a></td>
</tr>
EOS;
    }
    echo "</table>";
  }

  function showMessage($id, $pid = null) {
    if (!$pid) {
      $pid = $this->getDefaultPid($id);
    }
    $body = $this->getBody($id, $pid);
    $this->getParts($id, $pid);
    $h = $this->processHeaders($id, $pid);
    if ($body['ftype'] == 'text/plain') { // 顯示本文 (文字)
      $this->showHeader();
      $body = mb_convert_encoding($body['message'], mb_internal_encoding(), $this->text_charset);
      $body = nl2br($body);
      $subject = isset($_GET['fname']) ? $_GET['fname'] : $h['subject'];
      echo <<<EOS
<table border="1">
<tr><th>主旨</th><td>$subject</td></tr>
<tr><th>寄件者</th><td>{$h['from']}</td></tr>
<tr><th>送信時間</th><td>{$h['date']}</td></tr>
<tr><th>内容</th><td>$body</td></tr>
</table>
EOS;
    } else { // 顯示本文 (非文字)
      if (isset($_GET['fname']) && !empty($_GET['fname'])) {
        header('Content-Disposition: attachement; filename="'.
              $_GET['fname'].'"');
      }
      header('Content-Type: '.$body['ftype']);
      echo $body['message'];
      return;
    }

    if (isset($this->attachPid[$id])) { // 顯示附加檔名清單
      echo '<table border="1"><tr><th>附檔</th><td>';
      foreach ($this->attachPid[$id] as $i => $aid) {
        $fname_enc = $this->attachFname[$id][$i];
        $fname = mb_decode_mimeheader($fname_enc);
        $size = $this->convertBytes($this->attachFsize[$id][$i]);
        $url = $_SERVER['PHP_SELF']."?mid=$id";
        $url .= "&pid=".$this->attachPid[$id][$i];
        $url .= "&fname=".urlencode($fname_enc);
        echo "<a href=\"$url\">$fname ($size)</a><br/>";
      }
      echo '</td></tr></table>';
    }
    if (isset($this->inPid[$id])) { // 顯示內嵌檔名清單
      echo '<table border="1"><tr><th>內嵌檔</th><td>';
      foreach ($this->inPid[$id] as $i => $inid) {
        $fname_enc = $this->inFname[$id][$i];
        $fname = mb_decode_mimeheader($fname_enc);
         $size = $this->convertBytes($this->inFsize[$id][$i]);
        $url = $_SERVER['PHP_SELF']."?mid=$id";
        $url .= "&pid=".$this->inPid[$id][$i];
        $url .= "&fname=".urlencode($fname_enc);
        echo "<a href=\"$url\">$fname ($size)</a><br/>";
      }
      echo '</td></tr></table>';
    }
    $this->unsetParts($id);
    $this->unsetHeaders($id);
    $this->showFooter();
  }                                                          

  function deleteMessage($id) {
    $this->delete($id);
    $this->expunge();
    echo '郵件已刪除。';
    $this->showFooter();
  }

  private function processHeaders($id, $pid) {
    $this->getHeaders($id, $pid);
    $h['date'] = date('Y/m/d H:i',$this->header[$id]['udate']);
    $h['subject'] = mb_decode_mimeheader($this->header[$id]['subject']);
    $h['from'] = " &lt;{$this->header[$id]['from'][0]}&gt;";
    if (isset($this->header[$id]['from_personal'][0])) {
      $h['from'] = mb_decode_mimeheader($this->header[$id]['from_personal'][0]) . $h['from'];
    }
    $h['recent'] = $this->header[$id]['Recent'];
    $h['size'] = $this->header[$id]['Size'];
    return $h;
  }

  function messageCreate() {
   echo <<<EOS
<h1>傳送郵件</h1>
<table>
<form action="{$_SERVER['PHP_SELF']}?send" method="POST" enctype="multipart/form-data">
<tr><th>主旨：</th><td><input type="text" name="subject" size="40"></td></tr>
<tr><th>寄件者：</th><td><input type="text" name="from" size="40"></td></tr>
<tr><th>收件者：</th><td><input type="text" name="to" size="40"></td></tr>
<tr><th>附檔：</th><td><input type="file" name="file" size="40"></td></tr>
<tr><th>本文：</th><td>
       <textarea name="body" rows="4" cols="40">
       </textarea>
       </td></tr>
</table>
          <input type="submit" value="傳送郵件">
   </form>
EOS;
  }

  function messageSend() {
    $hdrs = array('To' => $_POST['to'], 
                  'From' => $_POST['from'],
                  'Subject' => mb_encode_mimeheader($_POST['subject'], $this->text_charset));

    $mime = new Mail_mime(); // 建立 MIME 郵件用的類別實體
    $mime->_build_params['text_charset'] = $this->text_charset;
    $mime->_build_params['head_charset'] = $this->text_charset;
    $mime->setTXTBody(mb_convert_encoding($_POST['body'], $this->text_charset)); // 追加文字部分
    if(is_uploaded_file($_FILES['file']['tmp_name'])){ // 如果有附件
      $name = $_FILES['file']['name'];
      $name_enc = mb_encode_mimeheader($name, $this->text_charset);
      $mime->addAttachment($_FILES['file']['tmp_name'], $_FILES['file']['type'], $name_enc); // 追加附件
      echo "已附加($name)檔案，";
    }
    $body = $mime->get(); // 取得本文
    $hdrs = $mime->headers($hdrs); // 取得標頭
    $mail = Mail::factory('smtp',array('host'=>$this->host)); // 建立 Mail 類別的實體
    $mail->send($_POST['to'], $hdrs, $body); // 傳送郵件
    echo "成功送出郵件。";
    $this->showFooter();
  }
}
?>
