<?php

/*
 * This file is a part of the Simple Authentication library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\SimpleAuthentication;

use EBT\SimpleAuthentication\Authentication\Authentications;
use EBT\SimpleAuthentication\Authentication\Authentication;
use EBT\SimpleAuthentication\Exception\AuthenticationException;

/**
 * Auth
 */
class Auth
{
    /**
     * @var Authentications
     */
    protected $authentications;

    /**
     * @param Authentications $authentications
     */
    public function __construct(Authentications $authentications)
    {
        $this->authentications = $authentications;
    }

    /**
     * @param Authentications $authentications
     *
     * @return Auth
     */
    public static function create(Authentications $authentications)
    {
        return new static($authentications);
    }

    /**
     * @param Authentication $authentication
     *
     * @return bool
     */
    public function authenticate(Authentication $authentication)
    {
        return $this->authentications->match($authentication);
    }

    /**
     * @param Authentication $authentication
     *
     * @throws AuthenticationException
     */
    public function authenticateOrException(Authentication $authentication)
    {
        if (!$this->authenticate($authentication)) {
            throw new AuthenticationException('Failed authentication');
        }
    }

    /**
     * @param mixed $key
     * @param mixed $secret
     *
     * @return bool
     */
    public function authenticateByKeyAndSecret($key, $secret)
    {
        $authentication = new Authentication($key, $secret);

        return $this->authenticate($authentication);
    }

    /**
     * @param mixed $key
     * @param mixed $secret
     */
    public function authenticateByKeyAndSecretOrException($key, $secret)
    {
        $authentication = new Authentication($key, $secret);

        $this->authenticateOrException($authentication);
    }
}
