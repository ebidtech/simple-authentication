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
use EBT\SimpleAuthentication\Credential\KeySecret\KeySecret;

/**
 * KeySecretTest
 */
class KeySecretTest extends TestCase
{
    public function testConstruct()
    {
        $key = 'key';
        $secret = 'secret';
        $keySecret = new KeySecret($key, $secret);
        $this->assertEquals($key, $keySecret->getKey());
        $this->assertEquals($secret, $keySecret->getSecret());
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
        $key = 'key';
        $secret = 'secret';
        $keySecret = new KeySecret($key, $secret);

        $keySecretArr = $keySecret->toArray();
        $this->assertEquals($key, $keySecretArr[$key]);
        $this->assertEquals($secret, $keySecretArr[$secret]);

        $this->assertEquals($keySecret, KeySecret::fromArray($keySecretArr));
    }

    public function testJsonEncode()
    {
        $key = 'the-key';
        $secret = 'the-secret';
        $keySecret = new KeySecret($key, $secret);

        $this->assertEquals('{"key":"the-key","secret":"the-secret"}', json_encode($keySecret));
    }
}
