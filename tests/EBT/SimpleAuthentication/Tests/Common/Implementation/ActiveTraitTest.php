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
use EBT\SimpleAuthentication\Common\Implementation\ActiveTrait;

/**
 * ActiveTraitTest
 */
class ActiveTraitTest extends TestCase
{
    use ActiveTrait;

    public function testIsActive()
    {
        // by default
        $this->assertTrue($this->isActive());

        $this->setActive(false);
        $this->assertFalse($this->isActive());
    }
}
