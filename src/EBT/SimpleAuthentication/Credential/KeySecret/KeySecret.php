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

use EBT\SimpleAuthentication\Exception\InvalidArgumentException;
use EBT\SimpleAuthentication\Credential\CredentialInterface;
use EBT\SimpleAuthentication\Common\Implementation\KeyTrait;
use EBT\SimpleAuthentication\Common\Implementation\SecretTrait;
use EBT\SimpleAuthentication\Common\Implementation\JsonSerializeFromArrayTrait;
use EBT\SimpleAuthentication\Common\Implementation\KeySecretIdentifierTrait;
use EBT\SimpleAuthentication\Common\Implementation\KeySecretTrait;
use EBT\SimpleAuthentication\Common\KeySecretInterface;

/**
 * KeySecret
 */
class KeySecret implements CredentialInterface, KeySecretInterface
{
    use KeySecretTrait;
    use JsonSerializeFromArrayTrait;
    use KeySecretIdentifierTrait;

    const KEY_KEY = 'key';
    const SECRET_KEY = 'secret';

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
     * @param mixed $key
     * @param mixed $secret
     */
    public function __construct($key, $secret)
    {
        $this->setKey($key);
        $this->setSecret($secret);
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
            throw new InvalidArgumentException('At Key secret from array missing required keys.');
        }

        return new static($data[static::KEY_KEY], $data[static::SECRET_KEY]);
    }
}
