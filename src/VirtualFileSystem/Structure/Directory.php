<?php
/*
 * This file is part of the php-vfs package.
 *
 * (c) Michael Donat <michael.donat@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace VirtualFileSystem\Structure;

use VirtualFileSystem\Exception\FileExistsException;
use VirtualFileSystem\Exception\NotFoundException;

/**
 * FileSystem Directory representation.
 *
 * @author Michael Donat <michael.donat@me.com>
 * @package php-vfs
 */
class Directory extends Node
{
    /**
     * @see http://man7.org/linux/man-pages/man2/lstat.2.html
     */
    const S_IFTYPE   = 0040000;

    protected $children = array();

    /**
     * Class constructor.
     *
     * @param string $basename
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($basename)
    {
        if ($basename == Root::BASENAME) {
            throw new \InvalidArgumentException('Creating directories as root is prohibited');
        }
        parent::__construct($basename);
    }

    /**
     * Adds child Directory.
     *
     * @param Directory $directory
     */
    public function addDirectory(Directory $directory)
    {
        $this->addNode($directory);
    }

    /**
     * Adds child File.
     *
     * @param File $file
     */
    public function addFile(File $file)
    {
        $this->addNode($file);
    }

    /**
     * Adds child Link.
     *
     * @param Link $link
     */
    public function addLink(Link $link)
    {
        $this->addNode($link);
    }

    /**
     * Adds child Node.
     *
     * @param Node $node
     *
     * @throws FileExistsException
     */
    public function addNode(Node $node)
    {
        if (array_key_exists($node->basename(), $this->children)) {
            throw new FileExistsException(sprintf('%s already exists', $node->basename()));
        }

        $this->children[$node->basename()] = $node;
        $node->setParent($this);
    }

    /**
     * Returns size as the number of child elements.
     *
     * @return int
     */
    public function size()
    {
        return count($this->children);
    }

    /**
     * Returns child Node existing at path.
     *
     * @param string $path
     *
     * @return Node
     *
     * @throws \VirtualFileSystem\Exception\NotFoundException
     */
    public function childAt($path)
    {
        if (!array_key_exists($path, $this->children)) {
            throw new NotFoundException(sprintf('Could not find child %s in %s', $path, $this->path()));
        }

        return $this->children[$path];
    }

    /**
     * Removes child Node
     *
     * @param string $basename
     */
    public function remove($basename)
    {
        unset($this->children[$basename]);
    }

    /**
     * Returns children
     *
     * @return array
     */
    public function children()
    {
        return $this->children;
    }
}
