<?php
require_once "PHPUnit2/Framework/TestCase.php";
require_once "Numeric.php";

class NumericTest extends PHPUnit2_Framework_TestCase {
  public $obj;

  public static function main() {
    require_once "PHPUnit2/Framework/TestSuite.php";
    require_once "PHPUnit2/TextUI/TestRunner.php";
    
    $suite  = new PHPUnit2_Framework_TestSuite("NumericTest");
    $result = PHPUnit2_TextUI_TestRunner::run($suite);
  }
  
  public function setUp() {
    $this->obj = new Numeric;
  }

  public function tearDown() {}

  public function testAdd() {
    $this->assertEquals(5, $this->obj->add(2,3));
  }
  
  public function testSub() {
    $this->assertEquals(-1, Numeric::sub(2,3));
  }
}
?>
