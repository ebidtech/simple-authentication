<?php

/*
 * This file is a part of the Simple Authentication library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\SimpleAuthentication\Tests\Credential\KeySecret\Loader;

use EBT\SimpleAuthentication\Tests\TestCase;
use EBT\SimpleAuthentication\Credential\KeySecret\Loader\KeySecretConfigLoader;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use Symfony\Component\Yaml\Yaml;
use EBT\SimpleAuthentication\Credential\KeySecret\KeySecretConfig;

/**
 * KeySecretConfigLoaderTest
 */
class KeySecretConfigLoaderTest extends TestCase
{
    /**
     * @var vfsStreamDirectory
     */
    private $root;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->root = vfsStream::setup('test');
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->root = null;

        parent::tearDown();
    }

    /**
     * @expectedException \EBT\SimpleAuthentication\Exception\InvalidArgumentException
     */
    public function testNoLoader()
    {
        (new KeySecretConfigLoader())->load('test');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage regular file
     */
    public function testLoadInvalidYamlFile()
    {
        KeySecretConfigLoader::create()->load('test.yml');
    }

    /**
     * @expectedException \EBT\SimpleAuthentication\Exception\InvalidArgumentException
     */
    public function testLoadYamlInvalidConfig()
    {
        $initialContent = array('hello' => 'world');
        $ymlContent = Yaml::dump($initialContent);

        vfsStream::create(array('file1.yml' => $ymlContent), $this->root);

        $this->assertEquals($initialContent, KeySecretConfigLoader::create()->load(vfsStream::url('test/file1.yml')));
    }

    /**
     * @dataProvider providerConfig
     */
    public function testLoadYaml($file, $content)
    {
        vfsStream::create(array($file => $content), $this->root);

        $keySecretsConfig = KeySecretConfigLoader::create()->load(vfsStream::url('test/' . $file));
        $this->assertCount(2, $keySecretsConfig);

        /** @var KeySecretConfig $keySecretConfig */
        $keySecretConfig = $keySecretsConfig->get('key1');
        $this->assertEquals('secret1', $keySecretConfig->getKeySecret()->getSecret());
        $this->assertFalse($keySecretConfig->isActive());

        /** @var KeySecretConfig $keySecretConfig */
        $keySecretConfig = $keySecretsConfig->get('key2');
        $this->assertEquals('secret2', $keySecretConfig->getKeySecret()->getSecret());
        $this->assertTrue($keySecretConfig->isActive());
    }

    /**
     * @return array
     */
    public function providerConfig()
    {
        $configArr = array(
            array(
                'credential' => array(
                    'key' => 'key1',
                    'secret' => 'secret1',
                ),
                'active' => false
            ),
            array(
                'credential' => array(
                    'key' => 'key2',
                    'secret' => 'secret2'
                )
            )
        );

        return array(
            array('file1.yml', Yaml::dump($configArr)),
            array('file1.json', json_encode($configArr))
        );
    }
}
