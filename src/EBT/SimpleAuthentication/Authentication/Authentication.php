<?php

/*
 * This file is a part of the Simple Authentication library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\SimpleAuthentication\Authentication;

use EBT\SimpleAuthentication\Exception\InvalidArgumentException;

/**
 * Authentication
 */
class Authentication
{
    const KEY_KEY = 'key';
    const SECRET_KEY = 'secret';
    const DESCRIPTION_KEY = 'description';

    const DEFAULT_DESCRIPTION = '';

    /**
     * @var mixed
     */
    protected $key;

    /**
     * @var mixed
     */
    protected $secret;

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @param mixed
     * @param mixed $secret
     * @param string $description
     *
     * @throws InvalidArgumentException
     */
    public function __construct($key, $secret, $description = self::DEFAULT_DESCRIPTION)
    {
        if (!is_scalar($key) || empty($key)) {
            throw new InvalidArgumentException(
                sprintf('Key needs to be empty or not scalar, got type: "%s"', gettype($key))
            );
        }

        if (!is_scalar($secret) || empty($secret)) {
            throw new InvalidArgumentException(
                sprintf('Secret needs to be empty or not scalar, got type: "%s"', gettype($secret))
            );
        }

        if (!is_string($description)) {
            throw new InvalidArgumentException('Description needs to be a string');
        }

        $this->key = $key;
        $this->secret = $secret;
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param Authentication $authentication
     *
     * @return bool True if both the key and secret matches
     */
    public function match(Authentication $authentication)
    {
        return $this->getKey() == $authentication->getKey() && $this->getSecret() == $authentication->getSecret();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            '%s: %s %s: %s %s: %s',
            static::KEY_KEY,
            $this->getKey(),
            static::SECRET_KEY,
            $this->getSecret(),
            static::DESCRIPTION_KEY,
            $this->getDescription()
        );
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            static::KEY_KEY => $this->getKey(),
            static::SECRET_KEY => $this->getSecret(),
            static::DESCRIPTION_KEY => $this->getDescription()
        );
    }

    /**
     * @param array $data array(
     *                        'key' => 'the key'
     *                        'secret' => 'the secret'
     *                        ['description' => 'some description']
     *                    )
     *
     * @return Authentication
     */
    public static function fromArray(array $data)
    {
        $key = isset($data[static::KEY_KEY]) ? $data[static::KEY_KEY] : '';
        $secret = isset($data[static::SECRET_KEY]) ? $data[static::SECRET_KEY] : '';
        $description = isset($data[static::DESCRIPTION_KEY])
            ? $data[static::DESCRIPTION_KEY]
            : static::DEFAULT_DESCRIPTION;

        return new static($key, $secret, $description);
    }
}
