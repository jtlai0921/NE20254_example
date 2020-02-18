<?php
// 錯誤處理函式
function error_handler ($errno, $errmsg, $file, $line, $vars) {
  $time = date("Y-m-d H:i:s");  // 錯誤發生時間
  // 將錯誤種類定義為關聯陣列
  $errortype = array (1=>"Error",2=>"Warning",4=>"Parsing Error",8=>"Notice",
                      16=>"Core Error",32=>"Core Warning",
                      64=>"Compile Error",128=>"Compile Warning",
                      256=>"User Error",512=>"User Warning",
                      1024=>"User Notice",2048=>"Strict Notice");
  $err = <<<EOS
 <errorentry>
    <time>$time</time>
    <number>$errno</number>
    <type>$errortype[$errno]</type>
    <errmsg>$errmsg</errmsg>
    <filename>$file</filename>
    <linenum>$line</linenum>
EOS;
  // 使用者定義的錯誤 / 通知的情況下記錄變數的值
  if ($errno & (E_USER_ERROR | E_USER_WARNING | E_USER_NOTICE)){
    $err .= "\n<vars>" . serialize($vars) . "</vars>";
  } 
  $err .= "\n</errorentry>\n";

  error_log($err, 3, "/tmp/error.log");    // 保存到記錄
  if ($errno == E_ERROR || $errno == E_USER_ERROR){ // 重大錯誤以Mail通知
    mb_send_mail("admin@example.com","錯誤發生通知",$err);
    echo "對不起。因為系統發生問題，停止服務中。";
    die();
  }
}
set_error_handler("error_handler"); // 設定錯誤處理函式
?>
