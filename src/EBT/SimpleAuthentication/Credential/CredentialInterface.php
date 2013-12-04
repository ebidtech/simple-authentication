<?php

/*
 * This file is a part of the Simple Authentication library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\SimpleAuthentication\Credential;

use EBT\SimpleAuthentication\Common\IdentifiableInterface;
use EBT\SimpleAuthentication\Common\ToArrayInterface;
use EBT\SimpleAuthentication\Common\FromArrayInterface;

/**
 * CredentialInterface, a credential represents a set of data that is usable to authenticate.
 */
interface CredentialInterface extends
 IdentifiableInterface,
 ToArrayInterface,
 FromArrayInterface,
 \JsonSerializable
{
}
