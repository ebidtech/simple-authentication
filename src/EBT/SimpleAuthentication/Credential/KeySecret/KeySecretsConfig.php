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

use EBT\SimpleAuthentication\Credential\CredentialsConfig;
use EBT\SimpleAuthentication\Exception\InvalidArgumentException;

/**
 * KeySecretsConfig
 */
class KeySecretsConfig extends CredentialsConfig
{
    /**
     * @param array $data array(
     *                        array(
     *                            'credential' => array(
     *                                'key' => 'key1',
     *                                'secret' => 'secret1'
     *                            ),
     *                            'active' => false
     *                        ),
     *                        array(
     *                            'credential' => array(
     *                                'key' => 'key2',
     *                                'secret' => 'secret2'
     *                            )
     *                        )
     *                    )
     *
     * @return KeySecretsConfig
     *
     * @throws InvalidArgumentException
     */
    public static function fromArray(array $data)
    {
        foreach ($data as $keySecretConfigArr) {
            if (!is_array($keySecretConfigArr)) {
                throw new InvalidArgumentException(
                    sprintf('Key secrets config expecting array got "%s"', gettype($keySecretConfigArr))
                );
            }
            $keySecretsConfig[] = KeySecretConfig::fromArray($keySecretConfigArr);
        }

        return new static($keySecretsConfig);
    }
}
