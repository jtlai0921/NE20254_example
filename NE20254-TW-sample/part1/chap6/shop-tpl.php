<?php 
require_once('config-tpl.php');
require_once('shopModel.php');
require_once('shopView-tpl.php');

session_start();

$model = new shopModel();
$view = new shopView();

$mode = isset($_SESSION['order']['mode']) ? $_SESSION['order']['mode'] : CMD_LIST;
switch ($mode) {
 case CMD_LIST:
   $data = $model->getList();
   $_SESSION['order']['mode'] = CMD_SHIP;
   break;
 case CMD_SHIP:
   $data = $model->addCart($_POST);
   $_SESSION['order']['mode'] = CMD_LAST;
   break;
 case CMD_LAST:
   $data = $model->saveShipment($_POST);
   $data['total'] = $model->getPrice();
   $_SESSION['order']['mode'] = CMD_LIST;
   break;
 default:
   die('invalid command.');
}

$view->assignData($mode,$data);
$view->setTemplate($mode);
$view->show();
?>
