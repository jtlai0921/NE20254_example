<?php  
require_once('err.inc'); // 讀入錯誤處理函式
function divide($num, $den){  // 進行除法的函式
  if ($den==0){ // 除數為0的情況下，發生使用者定義的錯誤
    trigger_error("Cannot divide by zero",E_USER_ERROR);
  } else {
    return ($num/$den);
  }
}
$val = SOME_STRING; // 因為常數未定義所以發生警告
echo divide(5, 0); // 因為除數為0所以發生使用者定義的重大錯誤
?>
