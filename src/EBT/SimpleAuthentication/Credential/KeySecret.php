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

use EBT\SimpleAuthentication\Exception\InvalidArgumentException;
use EBT\SimpleAuthentication\Common\Implementation\KeyTrait;
use EBT\SimpleAuthentication\Common\Implementation\SecretTrait;
use EBT\SimpleAuthentication\Common\Implementation\ActiveTrait;
use EBT\SimpleAuthentication\Common\Implementation\ExpiredTrait;
use EBT\SimpleAuthentication\Common\Implementation\LockedTrait;
use EBT\SimpleAuthentication\Common\Implementation\JsonSerializeFromArrayTrait;

/**
 * KeySecret
 */
class KeySecret implements CredentialInterface
{
    use KeyTrait;
    use SecretTrait;
    use ActiveTrait;
    use ExpiredTrait;
    use LockedTrait;
    use JsonSerializeFromArrayTrait;

    const KEY_KEY = 'key';
    const SECRET_KEY = 'secret';
    const KEY_ACTIVE = 'is_active';

    const DEFAULT_ACTIVE = true;

    /**
     * @param mixed $key
     * @param mixed $secret
     * @param bool  $active
     *
     * @throws InvalidArgumentException
     */
    public function __construct($key, $secret, $active = self::DEFAULT_ACTIVE)
    {
        $this->setKey($key);
        $this->setSecret($secret);
        $this->setActive($active);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdentifier()
    {
        return $this->getKey();
    }

    /**
     * {@inheritDoc}
     */
    public function match($toCompare)
    {
        return $toCompare instanceof KeySecret
        && $this->getKey() == $toCompare->getKey()
        && $this->getSecret() == $toCompare->getSecret();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s: %s %s: %s', static::KEY_KEY, $this->getKey(), static::SECRET_KEY, $this->getSecret());
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        return array(
            static::KEY_KEY => $this->getKey(),
            static::SECRET_KEY => $this->getSecret()
        );
    }

    /**
     * @param array $data array(
     *                        'key' => 'some key'
     *                        'secret' => 'some secret'
     *                    )
     *
     * @return KeySecret
     *
     * @throws InvalidArgumentException
     */
    public static function fromArray(array $data)
    {
        if (!isset($data[static::KEY_KEY], $data[static::SECRET_KEY])) {
            throw new InvalidArgumentException('KeySecret fromArray() missing required keys.');
        }

        $active = isset($data[static::KEY_ACTIVE]) ? $data[static::KEY_ACTIVE] : static::DEFAULT_ACTIVE;

        return new static($data[static::KEY_KEY], $data[static::SECRET_KEY], $active);
    }
}
