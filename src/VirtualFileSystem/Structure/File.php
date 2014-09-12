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

use SplObjectStorage;

/**
 * Object representation of File.
 *
 * @author Michael Donat <michael.donat@me.com>
 * @package php-vfs
 */
class File extends Node
{
    /**
     * @see http://man7.org/linux/man-pages/man2/lstat.2.html
     */
    const S_IFTYPE   = 0100000;

    protected $data = null;

    /**
     * Resource with exclusive lock on this file
     * @var resource|null
     */
    private $exclusiveLock = null;

    /**
     * Resources with a shared lock on this file
     * @var SplObjectStorage
     */
    private $sharedLock;

    /**
     * @inherit
     */
    public function __construct($basename)
    {
        parent::__construct($basename);
        $this->sharedLock = new SplObjectStorage;
    }

    /**
     * Returns contents size.
     *
     * @return int
     */
    public function size()
    {
        return strlen($this->data);
    }

    /**
     * Returns contents.
     *
     * @return null
     */
    public function data()
    {
        return $this->data;
    }

    /**
     * Sets contents.
     *
     * @param $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    public function lock($resource, $operation)
    {
        if ($this->exclusiveLock === $resource) {
            $this->exclusiveLock = null;
        } else {
            $this->sharedLock->detach($resource);
        }

        if ($operation & LOCK_NB) {
            $operation -= LOCK_NB;
        }

        $unlock    = $operation === LOCK_UN;
        $exclusive = $operation === LOCK_EX;

        if ($unlock) {
            return true;
        }

        if ($this->exclusiveLock !== null) {
            return false;
        }

        if (!$exclusive) {
            $this->sharedLock->attach($resource);
            return true;
        }

        if ($this->sharedLock->count()) {
            return false;
        }

        $this->exclusiveLock = $resource;
        return true;
    }
}
