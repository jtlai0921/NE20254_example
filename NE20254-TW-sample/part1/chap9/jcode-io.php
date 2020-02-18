<?php // HTTP輸出入處理函式 (jcode 版)
 require_once("jcode-ini.php");

 // 輸出入字元碼轉換用處理函式
 function ob_jcode($buffer,$status) {
   global $int_enc, $out_enc;
   return JcodeConvert($buffer, $int_enc, $out_enc);
 }
 
// 字元碼轉換
function jcode_enc_trans(&$input) {
  global $input_enc, $int_enc, $out_enc;
  if ($input_enc == JC_AUTO) { // 字元碼自動檢測
    $code = AutoDetect(implode("", $input));
    if ($code == JC_UNKNOWN) {
      return JC_UNKNOWN;
    }
  }
  foreach ($input as $key => $val) {
    $input[$key] = JcodeConvert($val, $code, $int_enc);
  }
  return $code;     
}

// 輸出入的字元碼轉換
if (is_array($_POST)){
  $detected_enc[METHOD_POST] = jcode_enc_trans($_POST);
}
if (is_array($_GET)){
  $detected_enc[METHOD_GET] = jcode_enc_trans($_GET);
}
if (is_array($_COOKIE)){
  $detected_enc[METHOD_COOKIE] = jcode_enc_trans($_COOKIE);
}
ob_start("ob_jcode");
?>
