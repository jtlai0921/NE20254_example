<?php // HTTP��X�J�B�z�禡 (jcode ��)
 require_once("jcode-ini.php");

 // ��X�J�r���X�ഫ�γB�z�禡
 function ob_jcode($buffer,$status) {
   global $int_enc, $out_enc;
   return JcodeConvert($buffer, $int_enc, $out_enc);
 }
 
// �r���X�ഫ
function jcode_enc_trans(&$input) {
  global $input_enc, $int_enc, $out_enc;
  if ($input_enc == JC_AUTO) { // �r���X�۰��˴�
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

// ��X�J���r���X�ഫ
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
