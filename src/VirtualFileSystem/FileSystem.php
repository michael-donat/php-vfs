<?php
/*
 * This file is part of the php-vfs package.
 *
 * (c) Michael Donat <michael.donat@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace VirtualFileSystem;

use VirtualFileSystem\Structure\Directory;
use VirtualFileSystem\Structure\File;
use VirtualFileSystem\Structure\Root;
use VirtualFileSystem\Structure\Link;

/**
 * Main 'access' class to vfs implementation. It will register new stream wrapper on instantiation.
 *
 * This class provides methods to get access to Container as well as file URI helper.
 *
 * @author Michael Donat <michael.donat@me.com>
 * @package php-vfs
 */
class FileSystem
{
    protected $scheme;

    /**
     * @var Container
     */
    protected $container;

    /**
     * Class constructor. Will register both, the stream default options and wrapper handler.
     *
     * Note: Each FileSystem instance will create NEW stream wrapper/scheme.
     */
    public function __construct()
    {
        $this->scheme = uniqid('phpvfs');

        /* injecting components */
        $this->container = $container = new Container(new Factory());
        $this->container->root()->setScheme($this->scheme);

        $this->registerContextOptions($container);

        stream_wrapper_register($this->scheme, sprintf('\%s\%s', __NAMESPACE__, 'Wrapper'));
    }

    /**
     * Returns wrapper scheme.
     *
     * @return string
     */
    public function scheme()
    {
        return $this->scheme;
    }

    /**
     * Registers Container object as default context option for scheme associated with FileSystem instance.
     *
     * @param Container $container
     */
    protected function registerContextOptions(Container $container)
    {
        $defaultOptions = stream_context_get_options(stream_context_get_default());
        stream_context_set_default(array_merge(
            $defaultOptions,
            array($this->scheme => array('Container' => $container))
        ));
    }

    /**
     * Remoces wrapper registered for scheme associated with FileSystem instance.
     */
    public function __destruct()
    {
        stream_wrapper_unregister($this->scheme);
    }

    /**
     * Returns Container instance.
     *
     * @return Container
     */
    public function container()
    {
        return $this->container;
    }

    /**
     * Returns Root instance.
     *
     * @return Root
     */
    public function root()
    {
        return $this->container()->root();
    }

    /**
     * Returns absolute path to full URI path (with scheme)
     *
     * @param string $path - path without scheme
     *
     * @return string - path with scheme
     */
    public function path($path)
    {
        $path = ltrim($path, '/');

        return $this->scheme().'://'.$path;
    }

    /**
     * Creates and returns a directory
     *
     * @param string  $path
     * @param bool    $recursive
     * @param integer $mode
     *
     * @return Directory
     */
    public function createDirectory($path, $recursive = false, $mode = null)
    {
        return $this->container()->createDir($path, $recursive, $mode);
    }

    /**
     * Creates and returns a file
     *
     * @param string $path
     * @param string $data
     *
     * @return File
     */
    public function createFile($path, $data = null)
    {
        return $this->container()->createFile($path, $data);
    }

    /**
     * Creates fs structure
     *
     * @param array $structure
     */
    public function createStructure(array $structure)
    {
        $this->container()->createStructure($structure);
    }

    /**
     * Creates and returns a link
     *
     * @param string $path
     * @param string $destinationPath
     *
     * @return Link
     */
    public function createLink($path, $destinationPath)
    {
        return $this->container()->createLink($path, $destinationPath);
    }
}
