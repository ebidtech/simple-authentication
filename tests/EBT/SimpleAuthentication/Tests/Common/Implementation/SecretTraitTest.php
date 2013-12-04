<?php

/*
 * This file is a part of the Simple Authentication library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\SimpleAuthentication\Tests\Common\Implementation;

use EBT\SimpleAuthentication\Common\Implementation\SecretTrait;
use EBT\SimpleAuthentication\Tests\TestCase;

/**
 * SecretTraitTest
 */
class SecretTraitTest extends TestCase
{
    use SecretTrait;

    /**
     * @expectedException \EBT\SimpleAuthentication\Exception\InvalidArgumentException
     */
    public function testSecretObject()
    {
        $this->setSecret(new \stdClass());
    }

    public function testGet()
    {
        $secret = 'secret';
        $this->setSecret($secret);
        $this->assertEquals($secret, $this->getSecret());
    }
}
