<?php

/*
 * This file is a part of the Simple Authentication library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\SimpleAuthentication\Loader;

use EBT\ConfigLoader\YamlFileLoader;
use EBT\ConfigLoader\Exception\InvalidArgumentException;
use EBT\SimpleAuthentication\Authentication\Authentications;

/**
 * AuthenticationYamlFileLoader
 */
class AuthenticationYamlFileLoader extends YamlFileLoader
{
    /**
     * Loads a resource.
     *
     * @param mixed  $resource The resource
     * @param string $type     The resource type
     *
     * @return Authentications
     *
     * @throws InvalidArgumentException
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function load($resource, $type = null)
    {
        return Authentications::fromArray(parent::load($resource, $type));
    }
}
