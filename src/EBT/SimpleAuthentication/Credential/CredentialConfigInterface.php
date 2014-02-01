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

use EBT\SimpleAuthentication\Common\ActiveInterface;
use EBT\SimpleAuthentication\Common\ExpiredInterface;
use EBT\SimpleAuthentication\Common\LockedInterface;
use EBT\SimpleAuthentication\Common\ToArrayInterface;
use EBT\SimpleAuthentication\Common\FromArrayInterface;

/**
 * CredentialConfigInterface, this represents a credential configuration is a super set of a credential, it should have
 * the credential itself and other options like active, locked, etc.
 */
interface CredentialConfigInterface extends
    CredentialEmbeddedInterface,
    ActiveInterface,
    ExpiredInterface,
    LockedInterface,
    ToArrayInterface,
    FromArrayInterface,
    \JsonSerializable
{
}
