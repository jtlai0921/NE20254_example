<?php  
require_once('err.inc'); // エラー処理ハンドラの読込
function divide($num, $den){  // 割算を行なう関数
  if ($den==0){ // ゼロ割の場合はユーザ定義エラーを発生
    trigger_error("Cannot divide by zero",E_USER_ERROR);
  } else {
    return ($num/$den);
  }
}
$val = SOME_STRING; // 定数は未定義なので警告が発生。
echo divide(5, 0); // ゼロ割によりユーザ定義の重大なエラーが発生。
?>
