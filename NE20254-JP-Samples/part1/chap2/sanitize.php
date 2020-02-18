<?php
define('ERR_FORM_NORULES',    -1);
define('ERR_FORM_NOVALUE',    -2);
define('ERR_FORM_REGEX',      -4);
define('ERR_FORM_CTYPE',      -8);

function formSanitize(&$vars, $rules) {
  $result = array();
  foreach ($rules as $key => $r) {
    if (isset($r['required']) && $r['required'] == true
        && !isset($vars[$key])) {
      $result[$key] |= ERR_FORM_NOVALUE;      
    }    
  }
  foreach ($vars as $key => $value) {
    if (isset($rules[$key])) { // ルールが存在
      $r = $rules[$key];
      if (isset($r['ctype'])) { // ctype関数によるチェック
        $fun = 'ctype_' . $r['ctype'];
        $rc = $fun($vars[$key]); 
        if (!$rc) {
          $result[$key] |= ERR_FORM_CTYPE;
        }
      }
      if (isset($r['regex'])) { // 正規表現によるチェック
        if(!preg_match($r['regex'], $vars[$key])) {
          $result[$key] |= ERR_FORM_REGEX;      
        }
      }
      if (isset($r['type'])) { // 強制型変換
        settype($vars[$key], $r['type']);
      }
      if (isset($r['action'])) { // 関数の適用
        $fun = $r['action'];
        $vars[$key] = $fun($vars[$key]);
      }
    } else { // ルールが存在しない
      $result[$key] |= ERR_FORM_NORULES;
    }
  }
  return $result;
}
?>
