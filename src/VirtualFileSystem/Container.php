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

/**
 * Class to hold the filesystem structure as object representation. It also provides access and factory methods for
 * file system management.
 *
 * An instance of Container is registered as a default stream options when FileSystem class is instantiated - it is
 * later used by streamWrapper implementation to interact with underlying object representation.
 *
 * @author Michael Donat <michael.donat@me.com>
 * @package php-vfs
 * @api
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
     * @var Wrapper\PermissionHelper
     */
    protected $permissionHelper;

    /**
     * Class constructor. Sets factory and root object on init.
     *
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->setFactory($factory);
        $this->root = $this->factory()->getRoot();
        $this->setPermissionHelper(new Wrapper\PermissionHelper());
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
     * @return Root
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
    public function nodeAt($path)
    {
        $pathParts = array_filter(explode('/', str_replace('\\', '/', $path)), 'strlen');

        $node = $this->root();

        foreach ($pathParts as $level) {
            if ($node instanceof File) {
                throw new NotFoundException();
            }
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
    public function hasNodeAt($path)
    {
        try {
            $this->nodeAt($path);

            return true;
        } catch (NotFoundException $e) {
            return false;
        }
    }

    /**
     * Returns directory at given path
     *
     * @param string $path
     * @param bool $recursive
     * @param null|integer $mode
     *
     * @return Structure\Directory
     *
     * @throws NotDirectoryException
     * @throws NotFoundException
     */
    public function directoryAt($path)
    {
        $file = $this->nodeAt($path);

        if (!$file instanceof Directory) {
            throw new NotDirectoryException();
        }

        return $file;
    }

    /**
     * Returns file at given path
     *
     * @param string $path
     *
     * @return Structure\File
     *
     * @throws NotFileException
     * @throws NotFoundException
     */
    public function fileAt($path)
    {
        $file = $this->nodeAt($path);

        if (!$file instanceof File) {
            throw new NotFileException();
        }

        return $file;
    }

    /**
     * Creates Directory at given path.
     *
     * @param string       $path
     * @param bool         $recursive
     * @param null|integer $mode
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
            $parent = $this->directoryAt($parentPath);
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
     * Creates link at given path
     *
     * @param string $path
     * @param string $destination
     *
     * @return Structure\Link
     *
     */
    public function createLink($path, $destination)
    {

        $destination = $this->nodeAt($destination);

        if ($this->hasNodeAt($path)) {
            throw new \RuntimeException(sprintf('%s already exists', $path));
        }

        $parent =  $this->directoryAt(dirname($path));

        $parent->addLink($newLink = $this->factory()->getLink(basename($path), $destination));

        return $newLink;
    }

    /**
     * Creates file at given path
     *
     * @param string $path
     * @param string|null $data
     *
     * @return Structure\File
     *
     * @throws \RuntimeException
     */
    public function createFile($path, $data = null)
    {
        if ($this->hasNodeAt($path)) {
            throw new \RuntimeException(sprintf('%s already exists', $path));
        }

        $parent =  $this->directoryAt(dirname($path));

        $parent->addFile($newFile = $this->factory()->getFile(basename($path)));

        $newFile->setData($data);

        return $newFile;

    }

    /**
     * Creates struture
     *
     * @param array $structure
     * @param string $parent
     * @throws NotFoundException
     */
    public function createStructure(array $structure, $parent = '/')
    {
        foreach ($structure as $key => $value) {
            if (is_array($value)) {
                $this->createDir($parent.$key);
                $this->createStructure($value, $parent.$key.'/');
            } else {
                $this->createFile($parent.$key, $value);
            }
        }
    }

    /**
     * Moves Node from source to destination
     *
     * @param  string            $fromPath
     * @param  string            $toPath
     * @return bool
     * @throws \RuntimeException
     */
    public function move($fromPath, $toPath)
    {
        $fromNode = $this->nodeAt($fromPath);

        try {
            $nodeToOverride = $this->nodeAt($toPath);

            if (!is_a($nodeToOverride, get_class($fromNode))) {
                //nodes of a different type
                throw new \RuntimeException('Can\'t move.');
            }

            if ($nodeToOverride instanceof Directory) {
                if ($nodeToOverride->size()) {
                    //nodes of a different type
                    throw new \RuntimeException('Can\'t override non empty directory.');
                }
            }

            $this->remove($toPath, true);

        } catch (NotFoundException $e) {
            //nothing at destination, we're good
        }

        $toParent = $this->directoryAt(dirname($toPath));

        $fromNode->setBasename(basename($toPath));

        $toParent->addNode($fromNode);

        $this->remove($fromPath, true);

        return true;
    }

    /**
     * Removes node at $path
     *
     * @param string $path
     * @param bool   $recursive
     *
     * @throws \RuntimeException
     */
    public function remove($path, $recursive = false)
    {
        $fileToRemove = $this->nodeAt($path);

        if (!$recursive && $fileToRemove instanceof Directory) {
            throw new \RuntimeException('Won\'t non-recursively remove directory');
        }

        $this->directoryAt(dirname($path))->remove(basename($path));
    }

    /**
     * Returns PermissionHelper with given node in context
     *
     * @param Structure\Node $node
     *
     * @return \VirtualFileSystem\Wrapper\PermissionHelper
     */
    public function getPermissionHelper(Structure\Node $node)
    {
        return $this->permissionHelper->setNode($node);
    }

    /**
     * Sets permission helper instance
     *
     * @param \VirtualFileSystem\Wrapper\PermissionHelper $permissionHelper
     */
    public function setPermissionHelper($permissionHelper)
    {
        $this->permissionHelper = $permissionHelper;
    }
}
