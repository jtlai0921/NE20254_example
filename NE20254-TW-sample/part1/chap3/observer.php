<?php
abstract class Observer {
  abstract function update($action,$params);
}

class SendMail extends Observer { // Mail �o�H
  function update($action,$params) {
    $str = "{$params['name']} ���ͦ�";
    print "Mail �o�H::$str\n";
  }
}

class Log extends Observer { // Log �O��
  function update($action,$params) {
    $str = implode(":",$params);
    print "Log �O��::$str\n";
  }
}

class Observable {
  protected $obs = array();
  function callObservers($action,$params) {
    foreach ($this->obs as $key => $obs ) {
      $obs->update($action,$params);
    }
  }
  function addObserver(Observer $observer) {
    $this->obs[] = $observer;
  }
}

class MyShop extends Observable {
  function submit($name, $email) {
    $params['name'] = $name;
    $params['email'] = $email;
    $this->callObservers('submit',$params);    
  }
}

$shop = new MyShop();
$shop->addObserver(new SendMail());
$shop->addObserver(new Log());

$shop->submit('�a��ӭ�','taro@example.com');
?>
