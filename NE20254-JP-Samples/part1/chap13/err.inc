<?php
// エラーハンドラ関数
function error_handler ($errno, $errmsg, $file, $line, $vars) {
  $time = date("Y-m-d H:i:s");  // エラー発生時間
  // エラーの種類を表す連想配列を定義
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
  // ユーザ定義エラー/通知の場合は変数の値を記録
  if ($errno & (E_USER_ERROR | E_USER_WARNING | E_USER_NOTICE)){
    $err .= "\n<vars>" . serialize($vars) . "</vars>";
  } 
  $err .= "\n</errorentry>\n";

  error_log($err, 3, "/tmp/error.log");    // ログに保存
  if ($errno == E_ERROR || $errno == E_USER_ERROR){ // 重大なエラーはメールで通知
    mb_send_mail("admin@example.com","エラー発生通知",$err);
    echo "申し訳ありません。システム上の不備によりサービスを停止中です。";
    die();
  }
}
set_error_handler("error_handler"); // エラーハンドラ関数を設定
?>
