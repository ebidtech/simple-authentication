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

/**
 * CredentialEmbeddedInterface
 */
interface CredentialEmbeddedInterface
{
    /**
     * @return CredentialInterface
     */
    public function getCredential();

    /**
     * @param CredentialInterface $toCompare
     *
     * @return bool True if there is a match between the credential at config and the credential passed
     */
    public function match(CredentialInterface $toCompare);
}
