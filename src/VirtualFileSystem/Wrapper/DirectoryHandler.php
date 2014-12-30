<?php
/*
 * This file is part of the php-vfs package.
 *
 * (c) Michael Donat <michael.donat@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace VirtualFileSystem\Wrapper;

use VirtualFileSystem\Structure\Directory;

/**
 * User as directory handle by streamWrapper implementation.
 *
 * This class is responsible mainly iterating over directory.
 *
 * @author Michael Donat <michael.donat@me.com>
 * @package php-vfs
 */
class DirectoryHandler
{
    /**
     * @var Directory
     */
    protected $directory;

    /**
     * @var \ArrayIterator
     */
    protected $iterator;

    /**
     * Sets directory in context.
     *
     * @param Directory $directory
     */
    public function setDirectory(Directory $directory)
    {
        $this->directory = $directory;
        $this->iterator = new \ArrayIterator($directory->children());
    }

    /**
     * Returns children iterator
     *
     * @return ArrayIterator
     */
    public function iterator()
    {
        return $this->iterator;
    }
}
