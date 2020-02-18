<?php
interface Validation {
  function isValid($value);
}

class nameValidation implements Validation {
  function isValid($value) {
    if (strlen($value)<10 && ctype_alnum($value)) {
      return true;
    } else {
      return false;
    }
  }
}

class emailValidation implements Validation {
  function isValid($value) {
    if (preg_match('/^[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i',$value)) {
      return true;
    } else {
      return false;
    }
  }
}

class FormValidation {
  function validate($params) {
    $result = array();
    foreach($params as $key => $value){
      switch ($key) {
      case 'name': 
      case 'email': 
        $class = $key . "Validation";
        $obs = new $class();
        $result[$key] = $obs->isValid($value);
      }
    }
    return $result;
  }
}

// 測試用使用者輸入
$_POST['name'] = 'taro$';
$_POST['email'] = 'taro@example.com';

$result = FormValidation::validate($_POST);
foreach ($result as $key => $value) {
  $bool = $value ? "true":"false";
  print "$key::$bool\n";
}
?>
