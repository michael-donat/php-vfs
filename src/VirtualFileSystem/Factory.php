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
use VirtualFileSystem\Structure\Node;
use VirtualFileSystem\Structure\Root;
use VirtualFileSystem\Structure\File;

/**
 * Factory class to encapsulate object creation.
 *
 * @author Michael Donat <michael.donat@me.com>
 * @package php-vfs
 */
class Factory
{
    protected $userid;
    protected $groupid;

    /**
     * Class constructor. Sets user/group to current system user/group.
     *
     * On non POSIX systems both attributes will be set to 0
     *
     */
    public function __construct()
    {
        $this->userid = function_exists('posix_getuid') ? posix_getuid() : 0;
        $this->groupid = function_exists('posix_getgid') ? posix_getgid() : 0;
    }

    /**
     * Creates Root object.
     *
     * @return Node
     */
    public function getRoot()
    {
        return $this->updateMetadata(new Root());
    }

    /**
     * Updates time and ownership of a node
     *
     * @param Node $node
     *
     * @return Node
     */
    public function updateMetadata(Node $node)
    {
        $this->updateFileTimes($node);
        $this->updateOwnership($node);
        return $node;
    }

    /**
     * Update file a/c/m times
     *
     * @param Node $node
     * @return Node
     */
    public function updateFileTimes(Node $node)
    {
        $time = time();
        $node->setAccessTime($time);
        $node->setModificationTime($time);
        $node->setChangeTime($time);

        return $node;
    }

    /**
     * Sets default (current) uid/gui on object.
     *
     * @param Node $node
     *
     * @return Node
     */
    protected function updateOwnership(Node $node)
    {
        $node->chown($this->userid);
        $node->chgrp($this->groupid);

        return $node;
    }

    /**
     * Creates Directory object.
     *
     * @param string $basename
     *
     * @return Directory
     */
    public function getDir($basename)
    {
        return $this->updateMetadata(new Directory($basename));
    }

    /**
     * Creates File object.
     *
     * @param string $basename
     *
     * @return File
     */
    public function getFile($basename)
    {
        return $this->updateMetadata(new File($basename));
    }
}
