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
    if (isset($rules[$key])) { // �W�h�s�b
      $r = $rules[$key];
      if (isset($r['ctype'])) { // �Q�� ctype ����ˬd
        $fun = 'ctype_' . $r['ctype'];
        $rc = $fun($vars[$key]); 
        if (!$rc) {
          $result[$key] |= ERR_FORM_CTYPE;
        }
      }
      if (isset($r['regex'])) { // �Q�Υ��W��{�ˬd
        if(!preg_match($r['regex'], $vars[$key])) {
          $result[$key] |= ERR_FORM_REGEX;      
        }
      }
      if (isset($r['type'])) { // �j���૬
        settype($vars[$key], $r['type']);
      }
      if (isset($r['action'])) { // �M�Ψ禡
        $fun = $r['action'];
        $vars[$key] = $fun($vars[$key]);
      }
    } else { // �W�h���s�b
      $result[$key] |= ERR_FORM_NORULES;
    }
  }
  return $result;
}
?>
