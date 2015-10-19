<?php

require_once __DIR__ . '/../library/DrSlump/Protobuf.php';

use DrSlump\Protobuf;

class ProtobufTest extends \PHPUnit_Framework_TestCase {
  public function setUp() {
    Protobuf::autoload();
  }

  public function testAutloadsClasses() {
    $c = new Protobuf\Codec\Binary();
    $this->assertInstanceOf('DrSlump\Protobuf\Codec\Binary', $c, 'correctly autoloads classes');
  }

  public function testDefaultCodec() {
    $c = Protobuf::getCodec();
    $this->assertInstanceOf('DrSlump\Protobuf\CodecInterface', $c, 'returns default codec');
  }

  public function testReturnsPassedCodecInstance() {
    $passed = new Protobuf\Codec\Binary();
    $getted = Protobuf::getCodec($passed);
    $this->assertEquals($passed, $getted, 'returns the passed codec instance');
  }

  public function testRegisterNewCodec() {
    $setted = new Protobuf\Codec\Binary();
    Protobuf::registerCodec('test', $setted);
    $getted = Protobuf::getCodec('test');
    $this->assertEquals($getted, $setted, 'registers a new codec');
  }

  public function testRegisterDefaultCodec() {
    $setted = new Protobuf\Codec\Binary();
    Protobuf::setDefaultCodec($setted);
    $this->assertEquals(Protobuf::getCodec(), $setted, 'registers a new default codec');
  }

  public function testUnregisterCodec() {
    $setted = new Protobuf\Codec\Binary();
    Protobuf::registerCodec('test', $setted);
    $result = Protobuf::unregisterCodec('test');
    $this->assertTrue($result, 'unregisters a codec');
    $this->setExpectedException('DrSlump\Protobuf\Exception');
    Protobuf::getCodec('test');
    //$this->fail('Failing this test on purpose');
  }

  public function testUnregisterDefaultCodec() {
    $result = Protobuf::unregisterCodec('default');
    $this->assertTrue($result, 'unregisters default codec');
    $getted = Protobuf::getCodec();
    $this->assertInstanceOf('DrSlump\Protobuf\Codec\Binary', $getted, 'old default is given');
  }
}
