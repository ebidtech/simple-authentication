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
 * KeyTrait
 */
trait KeyTrait
{
    /**
     * @var mixed
     */
    protected $key;

    /**
     * @param mixed $key
     *
     * @throws InvalidArgumentException
     */
    protected function setKey($key)
    {
        if (!is_scalar($key) || empty($key)) {
            throw new InvalidArgumentException(
                sprintf('Key needs to be scalar and not empty, got type: "%s"', gettype($key))
            );
        }

        $this->key = $key;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }
}
