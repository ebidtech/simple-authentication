<?php

/*
 * This file is a part of the Simple Authentication library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\SimpleAuthentication\Common;

/**
 * FromArrayInterface
 */
interface FromArrayInterface
{
    /**
     * @param array $data
     *
     * @return static
     */
    public static function fromArray(array $data);
}
