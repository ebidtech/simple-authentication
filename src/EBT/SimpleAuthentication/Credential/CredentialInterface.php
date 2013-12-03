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
use EBT\SimpleAuthentication\Common\MatchableInterface;
use EBT\SimpleAuthentication\Common\ToArrayInterface;
use EBT\SimpleAuthentication\Common\FromArrayInterface;
use EBT\SimpleAuthentication\Common\ActiveInterface;
use EBT\SimpleAuthentication\Common\ExpiredInterface;
use EBT\SimpleAuthentication\Common\LockedInterface;

/**
 * CredentialInterface
 */
interface CredentialInterface extends
 IdentifiableInterface,
 MatchableInterface,
 ToArrayInterface,
 FromArrayInterface,
 ActiveInterface,
 ExpiredInterface,
 LockedInterface,
 \JsonSerializable
{
}
