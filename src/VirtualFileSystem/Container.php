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

use Symfony\Component\Config\Definition\Exception\Exception;
use VirtualFileSystem\Structure\Directory;
use VirtualFileSystem\Structure\File;
use VirtualFileSystem\Structure\Root;

/**
 * Class to hold the filesystem structure as object representation. It also provides access and factory methods for
 * file system management.
 *
 * An instance of Container is registered as a default stream options when FileSystem class is instantiated - it is
 * later used by streamWrapper implementation to interact with underlying object representation.
 *
 * @author Michael Donat <michael.donat@me.com>
 * @package php-vfs
 */
class Container
{
    /**
     * @var Root
     */
    protected $root;

    /**
     * @var Factory
     */
    protected $factory;

    /**
     * Class constructor. Sets factory and root object on init.
     *
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->setFactory($factory);
        $this->root = $this->factory()->getRoot();
    }

    /**
     * Sets Factory instance
     *
     * @param \VirtualFileSystem\Factory $factory
     */
    public function setFactory($factory)
    {
        $this->factory = $factory;
    }

    /**
     * Returns Factory instance
     *
     * @return \VirtualFileSystem\Factory
     */
    public function factory()
    {
        return $this->factory;
    }

    /**
     * Returns Root instance
     *
     * @return Directory
     */
    public function root()
    {
        return $this->root;
    }

    /**
     * Returns filesystem Node|Directory|File|Root at given path.
     *
     * @param string $path
     *
     * @return Structure\Node
     * 
     * @throws NotFoundException
     */
    public function fileAt($path)
    {
        $pathParts = array_filter(explode('/', $path), 'strlen');

        $node = $this->root();

        foreach ($pathParts as $level) {
            $node = $node->childAt($level);
        }

        return $node;
    }

    /**
     * Checks whether filesystem has Node at given path
     *
     * @param string $path
     *
     * @return bool
     */
    public function hasFileAt($path)
    {
        try {
            $this->fileAt($path);
            return true;
        } catch (NotFoundException $e) {
            return false;
        }
    }

    /**
     * Creates Directory at given path.
     *
     * @param string $path
     * @param bool $recursive
     * @param null $mode
     *
     * @return Structure\Directory
     *
     * @throws NotFoundException
     */
    public function createDir($path, $recursive = false, $mode = null)
    {
        $parentPath = dirname($path);
        $name = basename($path);

        try {
            $parent = $this->fileAt($parentPath);
        } catch (NotFoundException $e) {
            if (!$recursive) {
                throw new NotFoundException(sprintf('createDir: %s: No such file or directory', $parentPath));
            }
            $parent = $this->createDir($parentPath, $recursive, $mode);
        }

        $parent->addDirectory($newDirectory = $this->factory()->getDir($name));
        if (!is_null($mode)) {
            $newDirectory->chmod($mode);
        }

        return $newDirectory;
    }

    /**
     * Creates file at given path
     *
     * @param string $path
     * @param null $data
     *
     * @return Structure\File
     *
     * @throws \RuntimeException
     */
    public function createFile($path, $data = null)
    {
        try {
            $file = $this->fileAt($path);
            throw new \RuntimeException(sprintf('%s already exists', $path));
        } catch (NotFoundException $e) {

        }

        $parent =  $this->fileAt(dirname($path));

        $parent->addFile($newFile = $this->factory()->getFile(basename($path)));

        $newFile->setData($data);

        return $newFile;

    }

    /**
     * Moves Node from source to destination
     *
     * @param string $from
     * @param string $to
     * @return bool
     * @throws \RuntimeException
     */
    public function move($from, $to)
    {
        $fromNode = $this->fileAt($from);
        $toNode = $this->fileAt(dirname($to));
        $newNodeName = basename($to);

        try {
            $nodeAtToPath = $this->fileAt($to);
            if ($nodeAtToPath instanceof Directory) {
                $newNodeName = basename($from);
                $toNode = $nodeAtToPath;
            }
        } catch (NotFoundException $e) {
            $nodeAtToPath = null;
        }

        $fromNode->setBasename($newNodeName);

        if ($nodeAtToPath instanceof File) {
            if (!$fromNode instanceof File) {
                throw new \RuntimeException('Can\'t move directory onto a file');
            }
            $toNode->remove($nodeAtToPath->basename());
        }

        if ($fromNode instanceof File) {
            $toNode->addFile($fromNode);
        } else {
            $toNode->addDirectory($fromNode);
        }

        $this->remove($from, true);

        return true;
    }

    /**
     * Removes node at $path
     *
     * @param string $path
     * @param bool $recursive
     *
     * @throws \RuntimeException
     */
    public function remove($path, $recursive = false)
    {
        $fileToRemove = $this->fileAt($path);

        if (!$recursive && $fileToRemove instanceof Directory) {
            throw new \RuntimeException('Won\'t non-recursively remove directory');
        }

        $this->fileAt(dirname($path))->remove(basename($path));
    }
}
