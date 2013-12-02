<?php

/*
 * This file is a part of the Simple Authentication library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\SimpleAuthentication\Tests\Loader;

use EBT\SimpleAuthentication\Loader\AuthenticationYamlFileLoader;
use EBT\SimpleAuthentication\Tests\TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use Symfony\Component\Yaml\Yaml;
use EBT\SimpleAuthentication\Authentication\Authentication;

/**
 * AuthenticationYamlFileLoaderTest
 */
class AuthenticationYamlFileLoaderTest extends TestCase
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

    public function testLoad()
    {
        $initialContent = array(
            array(
                Authentication::KEY_KEY => 'key1',
                Authentication::SECRET_KEY => 'secret1'
            ),
            array(
                Authentication::KEY_KEY => 'key2',
                Authentication::SECRET_KEY => 'secret2',
                Authentication::DESCRIPTION_KEY => 'desc'
            )
        );
        $ymlContent = Yaml::dump($initialContent);

        vfsStream::create(array('file1' => $ymlContent), $this->root);

        $authentication = (new AuthenticationYamlFileLoader())->load(vfsStream::url('test/file1'));
        $this->assertCount(2, $authentication);
    }
}
