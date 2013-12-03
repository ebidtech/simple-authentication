<?php

/*
 * This file is a part of the Simple Authentication library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\SimpleAuthentication\Tests\Credential;

use EBT\SimpleAuthentication\Tests\TestCase;
use EBT\SimpleAuthentication\Credential\Credentials;
use EBT\SimpleAuthentication\Credential\KeySecret;

/**
 * CredentialsTest
 */
class CredentialsTest extends TestCase
{
    public function testIterable()
    {
        $credentialsArr = $this->getCredentialsArray();
        $credentials = new Credentials($credentialsArr);
        $this->assertCount(2, $credentials);

        foreach ($credentials as $credential) {
            $this->assertEquals(current($credentialsArr), $credential);
            next($credentialsArr);
        }
    }

    /**
     * @expectedException \EBT\SimpleAuthentication\Exception\InvalidArgumentException
     */
    public function testDuplicate()
    {
        new Credentials(
            array(
                new KeySecret('key1', 'secret2'),
                new KeySecret('key1', 'secret2')
            )
        );
    }

    public function testFetByIdentifier()
    {
        /** @var KeySecret[] $credentialsArr */
        $credentialsArr = $this->getCredentialsArray();
        $credentials = new Credentials($credentialsArr);

        $credential = current($credentialsArr);
        $this->assertEquals(
            $credential,
            $credentials->getByIdentifier(
                $credential->getIdentifier()
            )
        );

        $this->assertNull($credentials->getByIdentifier('absent'));
    }

    public function testMatch()
    {
        /** @var KeySecret[] $credentialsArr */
        $credentialsArr = $this->getCredentialsArray();
        $credentials = new Credentials($credentialsArr);

        $this->assertTrue($credentials->match(current($credentialsArr)));
        $this->assertFalse($credentials->match(new KeySecret('absent', 'secret')));
    }

    protected function getCredentialsArray()
    {
        return array(
            new KeySecret('key1', 'secret2'),
            new KeySecret('key2', 'secret2')
        );
    }
}
