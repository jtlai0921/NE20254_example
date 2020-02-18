<?php
require_once('config-tpl.php');
require_once('Smarty.class.php');

class shopView extends Smarty {
  public $tpl;
  public $device;

  function assignData($mode = CMD_LIST, $obj) {
    $this->assign("pageTitle","PHP Shop");
    switch ($mode) {
    case CMD_LIST:
      $this->assign('id', $obj['id']);
      $this->assign('name', $obj['name']);
      $this->assign('price', $obj['price']);
      break;
    case CMD_SHIP:
      if (isset($obj['yourname'])){
        $this->assign('yourname', $obj['yourname']);
      }
      if (isset($obj['address'])){
        $this->assign('address', $obj['address']);
      }
      break;
    case CMD_LAST:
      $method = array('poffice'=>'郵政劃撥','bank'=>'銀行轉帳');
      $this->assign('yourname', $obj['yourname']);
      $this->assign('address', $obj['address']);
      $this->assign('payment', $method[$obj['payment']]);
      $this->assign('total', $obj['total']);
      break;
    }
  }

  function setTemplate($mode = CMD_LIST) {
    global $templateMap;
    if (preg_match("/DoCoMo|J\-PHONE|KDDI/", $_SERVER['HTTP_USER_AGENT'])) {
      $this->device = BROWSER_MOBILE;      
    } else {
      $this->device = BROWSER_NON_MOBILE;
    }
    $this->tpl = $templateMap[$mode][$this->device];
  }

  function show() {
    switch ($this->device) {
    case BROWSER_MOBILE:
      mb_http_output("UTF-8"); // 輸出字集設為 UTF8
      ob_start("mb_output_handler"); // 轉換輸出字集
      $this->assign('encoding', 'UTF-8');
      break;
    case BROWSER_NON_MOBILE:
      $this->assign('encoding', 'Big5');
      break;
    }
    
    $this->display($this->tpl);
  }
}
?>
