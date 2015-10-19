<?php

require_once __DIR__ . '/../library/DrSlump/Protobuf.php';

error_reporting(E_ALL);

use \DrSlump\Protobuf;

Protobuf::autoload();

include_once __DIR__ . '/protos/addressbook.php';

class Issue11BugfixTest extends \PHPUnit_Framework_TestCase {
  public function setUp() {
    $codec = new Protobuf\Codec\Binary();
    Protobuf::setDefaultCodec($codec);
  }
  public function testBugfixIssue11() {
    // should serialize nested message
    $p = new tests\Person();

    $p->setName('Foo');
    $p->setId(2048);
    $p->setEmail('foo@bar.com');

    $phoneNumber = new tests\Person\PhoneNumber;
    $phoneNumber->setNumber('+8888888888');
    $p->setPhone($phoneNumber);

    $data = $p->serialize();
    $this->assertInternalType('string', $data);
  }
}
