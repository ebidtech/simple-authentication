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
 * ExpiredTrait
 */
trait ExpiredTrait
{
    /**
     * @var bool
     */
    protected $expired = false;

    /**
     * @param bool $expired
     */
    protected function setExpired($expired)
    {
        $this->expired = (bool) $expired;
    }

    /**
     * @return bool
     */
    public function isExpired()
    {
        return $this->expired;
    }
}
