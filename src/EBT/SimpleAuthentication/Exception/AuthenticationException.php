<?php

/*
 * This file is a part of the Simple Authentication library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\SimpleAuthentication\Exception;

use EBT\SimpleAuthentication\Credential\CredentialInterface;

/**
 * AuthenticationException
 */
class AuthenticationException extends InvalidArgumentException
{
    /**
     * @param CredentialInterface $credential
     *
     * @return AuthenticationException
     */
    public static function fromCredential(CredentialInterface $credential)
    {
        return new AuthenticationException(
            sprintf('Failed credential authentication with identifier "%s"', $credential->getIdentifier())
        );
    }
}
