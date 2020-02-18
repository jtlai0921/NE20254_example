<?php // HTTP�����Ͻ����ؿ� (jcode ��)
 require_once("jcode-ini.php");

 // ����ʸ���������Ѵ��ѥϥ�ɥ�ؿ�
 function ob_jcode($buffer,$status) {
   global $int_enc, $out_enc;
   return JcodeConvert($buffer, $int_enc, $out_enc);
 }
 
// ʸ���������Ѵ�
function jcode_enc_trans(&$input) {
  global $input_enc, $int_enc, $out_enc;
  if ($input_enc == JC_AUTO) { // ʸ�������ɼ�ư����
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

// �����ѿ���ʸ���������Ѵ�
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
