<?php

/*
 * This file is a part of the Simple Authentication library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\SimpleAuthentication\Tests;

use EBT\SimpleAuthentication\Auth;
use EBT\SimpleAuthentication\Authentication\Authentications;
use EBT\SimpleAuthentication\Authentication\Authentication;

/**
 * AuthTest
 */
class AuthTest extends TestCase
{
    public function testAuthenticateByKeyAndSecret()
    {
        $this->assertTrue($this->getAuth()->authenticateByKeyAndSecret('key1', 'secret1'));
        $this->assertFalse($this->getAuth()->authenticateByKeyAndSecret('key1', 'wrong-secret'));
        $this->assertFalse($this->getAuth()->authenticateByKeyAndSecret('key-absent', 'secret1'));
    }

    public function testAuthenticateByKeyAndSecretOrException()
    {
        $this->getAuth()->authenticateByKeyAndSecretOrException('key1', 'secret1');
    }

    /**
     * @expectedException \EBT\SimpleAuthentication\Exception\AuthenticationException
     */
    public function testAuthenticateByKeyAndSecretOrExceptionAbsentKey()
    {
        $this->getAuth()->authenticateByKeyAndSecretOrException('key-absent', 'secret1');
    }

    /**
     * @expectedException \EBT\SimpleAuthentication\Exception\AuthenticationException
     */
    public function testAuthenticateByKeyAndSecretOrExceptionWrongSecret()
    {
        $this->getAuth()->authenticateByKeyAndSecretOrException('key1', 'wrong-secret');
    }

    /**
     * @return Auth
     */
    protected function getAuth()
    {
        return Auth::create($this->getAuthentications());
    }

    /**
     * @return Authentications
     */
    protected function getAuthentications()
    {
        return new Authentications(
            array(
                new Authentication('key1', 'secret1'),
                new Authentication('key2', 'secret2')
            )
        );
    }
}
