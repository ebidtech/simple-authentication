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
 * ActiveTrait
 */
trait ActiveTrait
{
    /**
     * @var bool
     */
    protected $active = true;

    /**
     * @param bool $active
     */
    protected function setActive($active)
    {
        $this->active = (bool) $active;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }
}
