<?php

/*
 * This file is a part of the Simple Authentication library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\SimpleAuthentication\Tests\Authentication;

use EBT\SimpleAuthentication\Tests\TestCase;
use EBT\SimpleAuthentication\Authentication\Authentication;

/**
 * AuthenticationTest
 */
class AuthenticationTest extends TestCase
{
    /**
     * @expectedException \EBT\SimpleAuthentication\Exception\InvalidArgumentException
     */
    public function testKeyObject()
    {
        new Authentication(new \stdClass(), 'secret');
    }

    /**
     * @expectedException \EBT\SimpleAuthentication\Exception\InvalidArgumentException
     */
    public function testSecretObject()
    {
        new Authentication('key', new \stdClass());
    }

    /**
     * @expectedException \EBT\SimpleAuthentication\Exception\InvalidArgumentException
     */
    public function testDescriptionObject()
    {
        new Authentication('key', 'secret', new \stdClass());
    }

    public function testConstruct()
    {
        $key = 'key';
        $secret = 'secret';
        $description = 'description';

        $auth = new Authentication($key, $secret, $description);
        $this->assertEquals($key, $auth->getKey());
        $this->assertEquals($secret, $auth->getSecret());
        $this->assertEquals($description, $auth->getDescription());
    }

    public function testToString()
    {
        $authentication = new Authentication('key', 'secret');
        $this->assertInternalType('string', (string) $authentication);
    }

    public function testToFromArray()
    {
        $authentication = new Authentication('key', 'secret');
        Authentication::fromArray($authentication->toArray());
    }

    public function testMatch()
    {
        $authentication = new Authentication('key', 'secret');
        $this->assertTrue($authentication->match(new Authentication('key', 'secret')));
        $this->assertFalse($authentication->match(new Authentication('key1', 'secret')));
        $this->assertFalse($authentication->match(new Authentication('key', 'secret1')));
    }
}
