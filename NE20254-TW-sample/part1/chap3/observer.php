<?php
abstract class Observer {
  abstract function update($action,$params);
}

class SendMail extends Observer { // Mail 發信
  function update($action,$params) {
    $str = "{$params['name']} 先生收";
    print "Mail 發信::$str\n";
  }
}

class Log extends Observer { // Log 記錄
  function update($action,$params) {
    $str = implode(":",$params);
    print "Log 記錄::$str\n";
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

$shop->submit('鈴木太郎','taro@example.com');
?>
