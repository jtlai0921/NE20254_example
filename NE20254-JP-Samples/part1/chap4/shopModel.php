<?php
require_once('config.php');
require_once('DB.php');

class shopModel {
  function getList () {
    $db = DB::connect(DSN, false) or die('db connection failed.');
    $result = $db->query('SELECT * from product') or die('Query faild.');
    while ($result->fetchInto($data, DB_FETCHMODE_ASSOC)) {
      $obj['id'][] = $data['id'];
      $obj['name'][] = $data['name'];
      $obj['price'][] = $data['price'];
    }
    return $obj;
  }

  function addCart($input) {
    foreach($input as $key => $data) {
      if (preg_match("/^\d+$/", $key.$data)) {
        $_SESSION['order'][$key] = $data;
      }
    }
    return $_SESSION['order'];
  }

  function saveShipment($input) {
    $_SESSION['order']['yourname'] = strip_tags($input['yourname']);
    $_SESSION['order']['address'] = strip_tags($input['address']);
    $_SESSION['order']['payment'] = strip_tags($input['payment']);
    return $_SESSION['order'];
  }

  function getPrice () {
    $db = DB::connect(DSN, false) or die('db connection failed.');
    $result = $db->query('SELECT * from product') or die('Query faild.');
    while ($result->fetchInto($data, DB_FETCHMODE_ASSOC)) {
      $price[$data['id']] = $data['price'];
    }
    $total = 0;
    foreach($_SESSION['order'] as $key => $num) {
      if (isset($price[$key])) {
        $total += $price[$key]*$num;
      }
    }
    return $total;
  }
}
?>
