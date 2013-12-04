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

use EBT\Collection\CollectionDirectAccessInterface;
use EBT\Collection\DirectAccessTrait;
use EBT\Collection\EmptyTrait;
use EBT\Collection\IterableTrait;
use EBT\Collection\CountableTrait;
use EBT\Collection\GetCollectionTrait;
use EBT\SimpleAuthentication\Exception\InvalidArgumentException;
use EBT\SimpleAuthentication\Exception\AuthenticationException;

/**
 * CredentialsConfig, collection of CredentialConfig
 */
class CredentialsConfig implements CollectionDirectAccessInterface
{
    use DirectAccessTrait;
    use EmptyTrait;
    use IterableTrait;
    use CountableTrait;
    use GetCollectionTrait;

    /**
     * @var CredentialConfigInterface[]
     */
    protected $collection;

    /**
     * @param array $credentialsConfig
     */
    public function __construct(array $credentialsConfig = array())
    {
        foreach ($credentialsConfig as $credentialConfig) {
            $this->add($credentialConfig);
        }
    }

    /**
     * @param CredentialConfigInterface $credentialConfig
     *
     * @throws InvalidArgumentException
     */
    protected function add(CredentialConfigInterface $credentialConfig)
    {
        $identifier = $credentialConfig->getCredential()->getIdentifier();

        if ($this->get($identifier) instanceof CredentialConfigInterface) {
            throw new InvalidArgumentException(
                sprintf('The credential with identifier "%s" is already present at credentials list', $identifier)
            );
        }

        $this->collection[$identifier] = $credentialConfig;
    }

    /**
     * @param CredentialInterface $credential
     *
     * @return bool
     */
    public function auth(CredentialInterface $credential)
    {
        /** @var CredentialConfigInterface $credentialConfig */
        foreach ($this as $credentialConfig) {
            if ($credentialConfig->match($credential)
                && $credentialConfig->isActive()
                && !$credentialConfig->isExpired()
                && !$credentialConfig->isLocked()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param CredentialInterface $credential
     *
     * @throws AuthenticationException
     */
    public function authOrException(CredentialInterface $credential)
    {
        if (!$this->auth($credential)) {
            throw AuthenticationException::fromCredential($credential);
        }
    }
}
