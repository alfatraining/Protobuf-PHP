<?php

require_once __DIR__ . '/../library/DrSlump/Protobuf.php';

use \DrSlump\Protobuf;

Protobuf::autoload();

include_once __DIR__ . '/protos/complex.php';

class EnumSupportTest extends \PHPUnit_Framework_TestCase {
  public function setUp() {
    Protobuf::setDefaultCodec(new ProtoBuf\Codec\Json);
  }

  public function testObtainAllPossibleEnumValues() {
    $enum = Tests\Complex\Enum::getInstance();
    $enumArray = $enum->toArray();
    $this->assertEquals(gettype($enumArray), 'array');
    $this->assertEquals(count($enumArray), 3);

    foreach ($enumArray as $k => $v) {
      $this->assertEquals($v, $enumArray[$k]);
    }
  }

  public function testArrayAccess() {
    $enum = Tests\Complex\Enum::getInstance();
    $this->assertEquals($enum->FOO, $enum['FOO']);
  }

  public function testEnumValueNameByIntegerValue() {
    $enum = Tests\Complex\Enum::getInstance();
    $this->assertEquals($enum[$enum->FOO], 'FOO');
  }
}
