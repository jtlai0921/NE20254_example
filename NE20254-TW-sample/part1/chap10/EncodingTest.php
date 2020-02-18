<?php
require_once "PHPUnit2/Framework/TestCase.php";

class EncodingTest extends PHPUnit2_Framework_TestCase {
  private $curl;
  public $target;
  public $cstr = "中文";
  public $enc = "UTF-8";

  public static function main() {
    require_once "PHPUnit2/Framework/TestSuite.php";
    require_once "PHPUnit2/TextUI/TestRunner.php";
    $suite  = new PHPUnit2_Framework_TestSuite("EncodingTest");
    $result = PHPUnit2_TextUI_TestRunner::run($suite);
  }
  public function setUp() {
    $this->target = "http://php/part1/chap10/enc.php";
    $this->curl = curl_init($this->target);
    curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
  }
  public function tearDown() {
    $ret = curl_exec($this->curl);
    $this->assertRegExp("/<!-- encoding:$this->enc -->/", $ret);
    print md5($ret);
  }
  public function testPOST() {
    curl_setopt($this->curl, CURLOPT_POST, 1); // 讓POST有效
    $param = "str=".mb_convert_encoding($this->cstr,$this->enc);
    curl_setopt($this->curl, CURLOPT_POSTFIELDS, $param);
  }
  public function testGET() {
    $param = "str=".urlencode(mb_convert_encoding($this->cstr,$this->enc));
    curl_setopt($this->curl, CURLOPT_URL, $this->target."?".$param);
  }
  public function testCookie() {
    $param = "str=".mb_convert_encoding($this->cstr,$this->enc);
    curl_setopt($this->curl, CURLOPT_COOKIE, $param);
  }
}
?>
