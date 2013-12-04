<?php

/*
 * This file is a part of the Simple Authentication library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\SimpleAuthentication\Tests\Credential\KeySecret;

use EBT\SimpleAuthentication\Tests\TestCase;
use EBT\SimpleAuthentication\Credential\KeySecret\KeySecretConfig;
use EBT\SimpleAuthentication\Credential\KeySecret\KeySecret;
use EBT\SimpleAuthentication\Credential\CredentialInterface;
use EBT\SimpleAuthentication\Common\KeySecretInterface;

/**
 * KeySecretConfigTest
 */
class KeySecretConfigTest extends TestCase
{
    /**
     * @expectedException \EBT\SimpleAuthentication\Exception\InvalidArgumentException
     */
    public function testConstructKeySecretNotImplementsCredentialInterface()
    {
        /** @var KeySecretInterface $keySecret */
        $keySecret = $this->getMock('EBT\SimpleAuthentication\Common\KeySecretInterface');
        new KeySecretConfig($keySecret);
    }

    public function testConstructDefaults()
    {
        $key = 'akey';
        $secret = 'asecret';

        $keySecretConfig = new KeySecretConfig(
            new KeySecret($key, $secret)
        );

        $this->assertEquals($key, $keySecretConfig->getKeySecret()->getKey());
        $this->assertEquals($secret, $keySecretConfig->getKeySecret()->getSecret());

        $this->assertTrue($keySecretConfig->isActive());
        $this->assertFalse($keySecretConfig->isExpired());
        $this->assertFalse($keySecretConfig->isLocked());
    }

    public function testDefaultsFromArray()
    {
        $keySecretConfig = KeySecretConfig::fromArray(
            array(
                KeySecretConfig::CREDENTIAL_KEY => array(
                    KeySecret::KEY_KEY => 'key1',
                    KeySecret::SECRET_KEY => 'secret1'
                )
            )
        );


        $this->assertTrue($keySecretConfig->isActive());
        $this->assertFalse($keySecretConfig->isExpired());
        $this->assertFalse($keySecretConfig->isLocked());
    }

    public function testMatch()
    {
        $key = 'akey';
        $secret = 'asecret';

        $keySecretConfig = new KeySecretConfig(
            new KeySecret($key, $secret)
        );

        $this->assertTrue($keySecretConfig->match(new KeySecret($key, $secret)));
        $this->assertFalse($keySecretConfig->match(new KeySecret('wrongkey', $secret)));
        $this->assertFalse($keySecretConfig->match(new KeySecret($key, 'wrongsecret')));

        $credential = $this->getMock('EBT\SimpleAuthentication\Credential\CredentialInterface');
        $credential->expects($this->never())
                    ->method('getKey');
        $credential->expects($this->never())
                   ->method('getSecret');

        /** @var CredentialInterface$credential */
        $this->assertFalse($keySecretConfig->match($credential));
    }

    /**
     * @expectedException \EBT\SimpleAuthentication\Exception\InvalidArgumentException
     */
    public function testFromArrayMissingCredential()
    {
        KeySecretConfig::fromArray(array());
    }

    public function testToFromArray()
    {
        $key = 'akey';
        $secret = 'asecret';

        $keySecretConfig = new KeySecretConfig(
            new KeySecret($key, $secret),
            true,
            false,
            true
        );

        $this->assertEquals($keySecretConfig, KeySecretConfig::fromArray($keySecretConfig->toArray()));
    }
}
