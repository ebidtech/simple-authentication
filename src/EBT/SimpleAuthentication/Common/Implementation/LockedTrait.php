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
 * LockedTrait
 */
trait LockedTrait
{
    /**
     * @var bool
     */
    protected $locked = false;

    /**
     * @param bool $locked
     */
    protected function setLocked($locked)
    {
        $this->locked = (bool) $locked;
    }

    /**
     * @return bool
     */
    public function isLocked()
    {
        return $this->locked;
    }
}
