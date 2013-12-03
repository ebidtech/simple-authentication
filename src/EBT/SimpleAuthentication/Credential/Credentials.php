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

use EBT\Collection\CollectionDirectInterface;
use EBT\Collection\IterableTrait;
use EBT\Collection\CountableTrait;
use EBT\Collection\EmptyTrait;
use EBT\Collection\DirectAccessTrait;
use EBT\Collection\GetCollectionTrait;
use EBT\SimpleAuthentication\Exception\InvalidArgumentException;

/**
 * Credentials
 */
class Credentials implements CollectionDirectInterface
{
    use IterableTrait;
    use CountableTrait;
    use EmptyTrait;
    use DirectAccessTrait {
        get as protected;
    }
    use GetCollectionTrait;

    /**
     * @var CredentialInterface[]
     */
    protected $collection = array();

    /**
     * @param CredentialInterface[] $credentials
     */
    public function __construct(array $credentials)
    {
        foreach ($credentials as $credential) {
            $this->add($credential);
        }
    }

    /**
     * @param CredentialInterface $credential
     *
     * @throws InvalidArgumentException In case an credential with same identifier is already present
     */
    protected function add(CredentialInterface $credential)
    {
        $identifier = (string) $credential->getIdentifier();

        if ($this->getByIdentifier($identifier) instanceof CredentialInterface) {
            throw new InvalidArgumentException(
                sprintf('An credential "%s" is already present.', $identifier)
            );
        }

        $this->collection[$identifier] = $credential;
    }

    /**
     * @param string $identifier
     *
     * @return CredentialInterface
     */
    public function getByIdentifier($identifier)
    {
        return $this->get($identifier);
    }

    /**
     * @param CredentialInterface $cred
     *
     * @return bool True if there is a credential that matches the one given as argument
     */
    public function match(CredentialInterface $cred)
    {
        $credential = $this->getByIdentifier($cred->getIdentifier());

        return ($credential instanceof CredentialInterface && $credential->match($cred));
    }
}
