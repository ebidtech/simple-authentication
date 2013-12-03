<?php

/*
 * This file is a part of the Simple Authentication library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\SimpleAuthentication\Common\Implementation;

use EBT\SimpleAuthentication\Exception\InvalidArgumentException;

/**
 * SecretTrait
 */
trait SecretTrait
{
    /**
     * @var mixed
     */
    protected $secret;

    /**
     * @param mixed $secret
     *
     * @throws InvalidArgumentException
     */
    protected function setSecret($secret)
    {
        if (!is_scalar($secret) || empty($secret)) {
            throw new InvalidArgumentException(
                sprintf('Secret needs to be scalar and not empty, got type: "%s"', gettype($secret))
            );
        }

        $this->secret = $secret;
    }

    /**
     * @return mixed
     */
    public function getSecret()
    {
        return $this->secret;
    }
}
