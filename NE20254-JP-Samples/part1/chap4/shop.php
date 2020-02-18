<?php 
require_once('config.php');
require_once('shopModel.php');
require_once('shopView.php');

session_start();

$model = new shopModel();
$view = new shopView();

$mode = isset($_SESSION['order']['mode']) ? $_SESSION['order']['mode'] : CMD_LIST;

$view->showHeader();

switch ($mode) {
 case CMD_LIST:
   $data = $model->getList();
   $_SESSION['order']['mode'] = CMD_SHIP;
   $view->showList($data);
   break;
 case CMD_SHIP:
   $data = $model->addCart($_POST);
   $_SESSION['order']['mode'] = CMD_LAST;
   $view->showShip($data);
   break;
 case CMD_LAST:
   $data = $model->saveShipment($_POST);
   $data['total'] = $model->getPrice();
   $_SESSION['order']['mode'] = CMD_LIST;
   $view->showLast($data);
   $view->showSession($data);
   break;
 default:
   die('invalid command.');
}

$view->showFooter();
?>
