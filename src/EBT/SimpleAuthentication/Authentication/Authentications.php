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

use EBT\Collection\CollectionDirectInterface;
use EBT\Collection\IterableTrait;
use EBT\Collection\CountableTrait;
use EBT\Collection\EmptyTrait;
use EBT\Collection\DirectAccessTrait;
use EBT\Collection\GetCollectionTrait;
use EBT\SimpleAuthentication\Exception\InvalidArgumentException;

/**
 * Authentications
 */
class Authentications implements CollectionDirectInterface
{
    use IterableTrait;
    use CountableTrait;
    use EmptyTrait;
    use DirectAccessTrait {
        get as protected;
    }
    use GetCollectionTrait;

    /**
     * @var Authentication[]
     */
    protected $collection = array();

    /**
     * @param Authentication[] $authentications
     *
     * @throws InvalidArgumentException
     */
    public function __construct(array $authentications)
    {
        foreach ($authentications as $authentication) {
            $this->add($authentication);
        }
    }

    /**
     * @param Authentication $authentication
     *
     * @throws InvalidArgumentException In case an authentication with same key is already present
     */
    protected function add(Authentication $authentication)
    {
        $key = (string) $authentication->getKey();

        if ($this->getByKey($key) instanceof Authentication) {
            throw new InvalidArgumentException(sprintf('An authentication with same name "%s" already present.', $key));
        }

        $this->collection[$key] = $authentication;
    }

    /**
     * @param string $key
     *
     * @return Authentication
     */
    public function getByKey($key)
    {
        return $this->get($key);
    }

    /**
     * @param Authentication $authentication
     *
     * @return bool True if there is a key
     */
    public function match(Authentication $authentication)
    {
        $auth = $this->getByKey($authentication->getKey());

        return ($auth instanceof Authentication && $auth->match($authentication));
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $authentications = array();

        /** @var Authentication $authentication */
        foreach ($this as $authentication) {
            $authentications[] = $authentication->toArray();
        }

        return $authentications;
    }

    /**
     * @param array $data array(
     *                        array('key' => 'some key', 'secret' => 'some secret'),
     *                        array('key' => 'another key', 'secret' => 'some secret', description => 'desc')
     *                    )
     *
     * @return Authentications
     */
    public static function fromArray(array $data)
    {
        $authentications = array();

        foreach ($data as $row) {
            $authentications[] = Authentication::fromArray($row);
        }

        return new static($authentications);
    }
}
