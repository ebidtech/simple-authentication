<?php

/*
 * This file is a part of the Simple Authentication library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\SimpleAuthentication\Tests\Credentials;

use EBT\SimpleAuthentication\Tests\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use EBT\SimpleAuthentication\Credential\KeySecret;
use EBT\SimpleAuthentication\Credential\CredentialInterface;

/**
 * KeySecretTest
 */
class KeySecretTest extends TestCase
{
    /**
     * @expectedException \EBT\SimpleAuthentication\Exception\InvalidArgumentException
     */
    public function testKeyObject()
    {
        new KeySecret(new \stdClass(), 'secret');
    }

    /**
     * @expectedException \EBT\SimpleAuthentication\Exception\InvalidArgumentException
     */
    public function testSecretObject()
    {
        new KeySecret('key', new \stdClass());
    }

    public function testConstruct()
    {
        $key = 'key';
        $secret = 'secret';
        $keySecret = new KeySecret($key, $secret, false);
        $this->assertEquals($key, $keySecret->getKey());
        $this->assertEquals($secret, $keySecret->getSecret());
        $this->assertFalse($keySecret->isActive());
    }

    public function testMatchNotKeySecret()
    {
        $key = 'key';
        $secret = 'secret';
        $keySecret = new KeySecret($key, $secret);

        /** @var PHPUnit_Framework_MockObject_MockObject|CredentialInterface $credentialMock */
        $credentialMock = $this->getMock('EBT\SimpleAuthentication\Credential\CredentialInterface');

        $credentialMock->expects($this->never())
                       ->method('getKey');

        $credentialMock->expects($this->never())
                       ->method('getSecret');

        $this->assertFalse($keySecret->match($credentialMock));
    }

    public function testMatchWrongKey()
    {
        $key = 'key';
        $secret = 'secret';
        $keySecret = new KeySecret($key, $secret);

        $this->assertFalse($keySecret->match(new KeySecret('wrongkey', $secret)));
    }

    public function testMatch()
    {
        $key = 'key';
        $secret = 'secret';
        $keySecret = new KeySecret($key, $secret);

        $keySecret->match(new KeySecret($key, $secret));
    }

    public function testToString()
    {
        $keySecret = new KeySecret('kkk', 'sss');
        $this->assertEquals('key: kkk secret: sss', (string) $keySecret);
    }

    /**
     * @expectedException \EBT\SimpleAuthentication\Exception\InvalidArgumentException
     */
    public function testFromArrayMissingKeys()
    {
        KeySecret::fromArray(array());
    }

    public function testToFromArray()
    {
        $keySecret = new KeySecret('key', 'secret');
        $this->assertEquals($keySecret, KeySecret::fromArray($keySecret->toArray()));
    }

    public function testJsonSerialize()
    {
        $this->assertEquals(
            json_encode(
                array(
                    KeySecret::KEY_KEY => 'k',
                    KeySecret::SECRET_KEY => 's'
                )
            ),
            json_encode(new KeySecret('k', 's'))
        );
    }
}
