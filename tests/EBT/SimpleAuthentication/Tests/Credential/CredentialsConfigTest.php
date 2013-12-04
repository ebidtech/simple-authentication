<?php

/*
 * This file is a part of the Collection library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\SimpleAuthentication\Tests\Credential;

use EBT\SimpleAuthentication\Tests\TestCase;
use EBT\SimpleAuthentication\Credential\CredentialsConfig;
use EBT\SimpleAuthentication\Credential\KeySecret\KeySecretConfig;
use EBT\SimpleAuthentication\Credential\KeySecret\KeySecret;

/**
 * CredentialsConfigTest
 */
class CredentialsConfigTest extends TestCase
{
    /**
     * @expectedException \EBT\SimpleAuthentication\Exception\InvalidArgumentException
     */
    public function testDuplicate()
    {
        new CredentialsConfig(
            array(
                new KeySecretConfig(new KeySecret('key', 'secret')),
                new KeySecretConfig(new KeySecret('key', 'secret'))
            )
        );
    }

    public function testIterable()
    {
        $credentialsConfigArr = array(
            new KeySecretConfig(new KeySecret('key1', 'secret1')),
            new KeySecretConfig(new KeySecret('key2', 'secret2'))
        );
        $credentialsConfig = new CredentialsConfig($credentialsConfigArr);

        $this->assertCount(2, $credentialsConfig);
        foreach ($credentialsConfig as $credentialConfig) {
            $this->assertEquals(current($credentialsConfigArr), $credentialConfig);
            next($credentialsConfigArr);
        }
    }
}
