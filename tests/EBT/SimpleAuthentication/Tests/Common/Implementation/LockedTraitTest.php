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

use EBT\SimpleAuthentication\Tests\TestCase;
use EBT\SimpleAuthentication\Common\Implementation\LockedTrait;

/**
 * LockedTraitTest
 */
class LockedTraitTest extends TestCase
{
    use LockedTrait;

    public function testSetGet()
    {
        $this->assertFalse($this->isLocked());
        $this->setLocked(true);
        $this->assertTrue($this->isLocked());
    }
}
