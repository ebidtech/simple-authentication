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

/**
 * KeySecretIdentifierTrait
 */
trait KeySecretIdentifierTrait
{
    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return mixed
     */
    abstract public function getKey();
}
