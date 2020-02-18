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
    if (isset($rules[$key])) { // �롼�뤬¸��
      $r = $rules[$key];
      if (isset($r['ctype'])) { // ctype�ؿ��ˤ������å�
        $fun = 'ctype_' . $r['ctype'];
        $rc = $fun($vars[$key]); 
        if (!$rc) {
          $result[$key] |= ERR_FORM_CTYPE;
        }
      }
      if (isset($r['regex'])) { // ����ɽ���ˤ������å�
        if(!preg_match($r['regex'], $vars[$key])) {
          $result[$key] |= ERR_FORM_REGEX;      
        }
      }
      if (isset($r['type'])) { // �������Ѵ�
        settype($vars[$key], $r['type']);
      }
      if (isset($r['action'])) { // �ؿ���Ŭ��
        $fun = $r['action'];
        $vars[$key] = $fun($vars[$key]);
      }
    } else { // �롼�뤬¸�ߤ��ʤ�
      $result[$key] |= ERR_FORM_NORULES;
    }
  }
  return $result;
}
?>
