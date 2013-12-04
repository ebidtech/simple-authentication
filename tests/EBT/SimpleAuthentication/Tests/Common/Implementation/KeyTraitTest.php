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

use EBT\SimpleAuthentication\Common\Implementation\KeyTrait;
use EBT\SimpleAuthentication\Tests\TestCase;

/**
 * KeyTraitTest
 */
class KeyTraitTest extends TestCase
{
    use KeyTrait;

    /**
     * @expectedException \EBT\SimpleAuthentication\Exception\InvalidArgumentException
     */
    public function testSetObject()
    {
        $this->setKey(new \stdClass());
    }

    public function testGet()
    {
        $key = 'key';
        $this->setKey($key);
        $this->assertEquals($key, $this->getKey());
    }
}
