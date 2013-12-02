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
use EBT\SimpleAuthentication\Authentication\Authentications;

/**
 * AuthenticationsTest
 */
class AuthenticationsTest extends TestCase
{
    public function testIterable()
    {
        $authenticationsArr = $this->getAuthenticationsArray();
        $authentications = new Authentications($authenticationsArr);

        $this->assertCount(2, $authentications);

        foreach ($authentications as $authentication) {
            $this->assertEquals(current($authenticationsArr), $authentication);
            next($authenticationsArr);
        }
    }

    public function testGet()
    {
        $authenticationsArr = $this->getAuthenticationsArray();
        $authentications = new Authentications($authenticationsArr);

        $first = $authenticationsArr[0];
        $this->assertEquals($first, $authentications->getByKey($first->getKey()));
        $this->assertNull($authentications->getByKey('absent'));
    }

    public function testToFromArray()
    {
        $authentications = new Authentications($this->getAuthenticationsArray());
        $this->assertEquals($authentications, Authentications::fromArray($authentications->toArray()));
    }

    public function testMatch()
    {
        $authentications = new Authentications($this->getAuthenticationsArray());
        $this->assertTrue($authentications->match(new Authentication('key1', 'secret1')));
        $this->assertFalse($authentications->match(new Authentication('key1', 'wrong-secret')));
        $this->assertTrue($authentications->match(new Authentication('key2', 'secret2')));
        $this->assertFalse($authentications->match(new Authentication('key2', 'wrong-secret')));
        $this->assertFalse($authentications->match(new Authentication('key3', 'secret3')));
    }

    /**
     * @expectedException \EBT\SimpleAuthentication\Exception\InvalidArgumentException
     */
    public function testDuplicate()
    {
        new Authentications(
            array(
                new Authentication('key1', 'secret1'),
                new Authentication('key1', 'secret1')
            )
        );
    }

    /**
     * @return Authentication[]
     */
    protected function getAuthenticationsArray()
    {
        return array(
            new Authentication('key1', 'secret1'),
            new Authentication('key2', 'secret2')
        );
    }
}
