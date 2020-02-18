<?php
require_once "PHPUnit2/Framework/TestCase.php";

class EncodingTest extends PHPUnit2_Framework_TestCase {
  private $curl;
  public $target;
  public $jstr = "日本語";
  public $enc = "UTF-8";

  public static function main() {
    require_once "PHPUnit2/Framework/TestSuite.php";
    require_once "PHPUnit2/TextUI/TestRunner.php";
    $suite  = new PHPUnit2_Framework_TestSuite("EncodingTest");
    $result = PHPUnit2_TextUI_TestRunner::run($suite);
  }
  public function setUp() {
    $this->target = "http://www.example.com/php/debug/enc.php";
    $this->curl = curl_init($this->target);
    curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
  }
  public function tearDown() {
    $ret = curl_exec($this->curl);
    $this->assertRegExp("/<!-- encoding:$this->enc -->/", $ret);
  }
  public function testPOST() {
    curl_setopt($this->curl, CURLOPT_POST, 1); // POSTを有効に
    $param = "str=".mb_convert_encoding($this->jstr,$this->enc);
    curl_setopt($this->curl, CURLOPT_POSTFIELDS, $param);
  }
  public function testGET() {
    $param = "str=".urlencode(mb_convert_encoding($this->jstr,$this->enc));
    curl_setopt($this->curl, CURLOPT_URL, $this->target."?".$param);
  }
  public function testCookie() {
    $param = "str=".mb_convert_encoding($this->jstr,$this->enc);
    curl_setopt($this->curl, CURLOPT_COOKIE, $param);
  }
}
?>
