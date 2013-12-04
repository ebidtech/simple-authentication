<?php

/*
 * This file is a part of the Simple Authentication library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\SimpleAuthentication\Credential\KeySecret\Loader;

use EBT\SimpleAuthentication\Credential\KeySecret\KeySecretsConfig;
use Symfony\Component\Config\Loader\LoaderInterface;
use EBT\ConfigLoader\YamlFileLoader;
use EBT\ConfigLoader\JsonFileLoader;
use EBT\SimpleAuthentication\Exception\InvalidArgumentException;

/**
 * KeySecretConfigFileLoader
 */
class KeySecretConfigLoader
{
    /**
     * @var LoaderInterface[] An array of LoaderInterface objects
     */
    protected $loaders = array();

    /**
     * Constructor.
     *
     * @param LoaderInterface[] $loaders An array of loaders
     */
    public function __construct(array $loaders = array())
    {
        foreach ($loaders as $loader) {
            $this->addLoader($loader);
        }
    }

    /**
     * Adds a loader.
     *
     * @param LoaderInterface $loader A LoaderInterface instance
     */
    protected function addLoader(LoaderInterface $loader)
    {
        $this->loaders[] = $loader;
    }

    /**
     * Loads a resource.
     *
     * @param mixed       $resource The resource
     * @param string|null $type     The resource type
     *
     * @return KeySecretsConfig
     *
     * @throws InvalidArgumentException
     */
    public function load($resource, $type = null)
    {
        foreach ($this->loaders as $loader) {
            if ($loader->supports($resource, $type)) {
                return KeySecretsConfig::fromArray($loader->load($resource, $type));
            }
        }

        $resourceStr = (is_scalar($resource) || (is_object($resource) && method_exists($resource, '__toString()')))
            ? (string) $resource
            : gettype($resource);

        $typeStr = (is_scalar($type) || (is_object($type) && method_exists($type, '__toString()')))
            ? (string) $type
            : gettype($type);

        throw new InvalidArgumentException(
            sprintf('Cannot find a loader to the resource "%s" and type "%s"', $resourceStr, $typeStr)
        );
    }

    /**
     * Will create the loader with some default loaders
     */
    public static function create()
    {
        return new static(
            array(
                new YamlFileLoader(),
                new JsonFileLoader()
            )
        );
    }
}
