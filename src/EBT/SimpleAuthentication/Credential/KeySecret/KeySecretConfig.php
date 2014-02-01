<?php

/*
 * This file is a part of the Simple Authentication library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\SimpleAuthentication\Credential\KeySecret;

use EBT\SimpleAuthentication\Common\KeySecretInterface;
use EBT\SimpleAuthentication\Exception\InvalidArgumentException;
use EBT\SimpleAuthentication\Credential\CredentialConfigInterface;
use EBT\SimpleAuthentication\Credential\CredentialInterface;
use EBT\SimpleAuthentication\Common\Implementation\ActiveTrait;
use EBT\SimpleAuthentication\Common\Implementation\ExpiredTrait;
use EBT\SimpleAuthentication\Common\Implementation\LockedTrait;
use EBT\SimpleAuthentication\Common\Implementation\JsonSerializeFromArrayTrait;

/**
 * KeySecretConfig
 */
class KeySecretConfig implements CredentialConfigInterface
{
    use ActiveTrait;
    use ExpiredTrait;
    use LockedTrait;
    use JsonSerializeFromArrayTrait;

    const CREDENTIAL_KEY = 'credential';
    const ACTIVE_KEY = 'active';
    const EXPIRED_KEY = 'expired';
    const LOCKED_KEY = 'locked';

    const DEFAULT_ACTIVE = true;
    const DEFAULT_EXPIRED = false;
    const DEFAULT_LOCKED = false;

    /**
     * @var KeySecretInterface
     */
    protected $keySecret;

    /**
     * @param KeySecretInterface $keySecret
     * @param bool               $active
     * @param bool               $expired
     * @param bool               $locked
     *
     * @throws InvalidArgumentException
     */
    public function __construct(
        KeySecretInterface $keySecret,
        $active = self::DEFAULT_ACTIVE,
        $expired = self::DEFAULT_EXPIRED,
        $locked = self::DEFAULT_LOCKED
    ) {
        if (!$keySecret instanceof CredentialInterface) {
            throw new InvalidArgumentException('The key secret must implement credential.');
        }

        $this->keySecret = $keySecret;
        $this->setActive($active);
        $this->setExpired($expired);
        $this->setLocked($locked);
    }

    /**
     * @return KeySecretInterface
     */
    public function getKeySecret()
    {
        return $this->keySecret;
    }

    /**
     * @return CredentialInterface
     */
    public function getCredential()
    {
        return $this->getKeySecret();
    }

    /**
     * {@inheritDoc}
     */
    public function match(CredentialInterface $toCompare)
    {
        return ($toCompare instanceof KeySecretInterface
            && $this->getKeySecret()->getKey() === $toCompare->getKey()
            && $this->getKeySecret()->getSecret() === $toCompare->getSecret()
        );
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            static::CREDENTIAL_KEY => $this->getCredential()->toArray(),
            static::ACTIVE_KEY => $this->isActive(),
            static::EXPIRED_KEY => $this->isExpired(),
            static::LOCKED_KEY => $this->isLocked()
        );
    }

    /**
     * @param array $data
     *
     * @return KeySecretConfig
     *
     * @throws InvalidArgumentException
     */
    public static function fromArray(array $data)
    {
        if (!isset($data[static::CREDENTIAL_KEY])) {
            throw new InvalidArgumentException('At key secret config from array missing the credential');
        }

        return new static(
            KeySecret::fromArray($data[static::CREDENTIAL_KEY]),
            static::getFromArrayActive($data),
            static::getFromArrayExpired($data),
            static::getFromArrayLocked($data)
        );
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    protected static function getFromArrayActive(array $data)
    {
        return isset($data[static::ACTIVE_KEY]) ? $data[static::ACTIVE_KEY] : static::DEFAULT_ACTIVE;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    protected static function getFromArrayExpired(array $data)
    {
        return isset($data[static::EXPIRED_KEY]) ? $data[static::EXPIRED_KEY] : static::DEFAULT_EXPIRED;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    protected static function getFromArrayLocked(array $data)
    {
        return isset($data[static::LOCKED_KEY]) ? $data[static::LOCKED_KEY] : static::DEFAULT_LOCKED;
    }
}
