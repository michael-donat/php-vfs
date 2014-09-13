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

use VirtualFileSystem\Structure\Node;

/**
 * Class to encapsulate permission checks
 *
 * @author Michael Donat <michael.donat@me.com>
 * @package php-vfs
 * @api
 */
class PermissionHelper
{
    const MODE_USER_READ = 0400;
    const MODE_USER_WRITE = 0200;

    const MODE_GROUP_READ = 0040;
    const MODE_GROUP_WRITE = 0020;

    const MODE_WORLD_READ = 0004;
    const MODE_WORLD_WRITE = 0002;

    /**
     * @var Node
     */
    protected $node;

    protected $userid;
    protected $groupid;

    /**
     * @param int $uid
     * @param int $gid
     */
    public function __construct($uid = null, $gid = null)
    {
        $this->userid = is_null($uid) ? (function_exists('posix_getuid') ? posix_getuid() : 0) : $uid;
        $this->groupid = is_null($gid) ? ((function_exists('posix_getgid') ? posix_getgid() : 0)) : $gid;
    }

    /**
     * Checks whether user_id on file is the same as executing user
     *
     * @return bool
     */
    public function userIsOwner()
    {
        return (bool) ($this->userid == $this->node->user());
    }

    /**
     * Checks whether file is readable for user
     *
     * @return bool
     */
    public function userCanRead()
    {
        return $this->userIsOwner() && ($this->node->mode() & self::MODE_USER_READ);
    }

    /**
     * Checks whether file is writable for user
     *
     * @return bool
     */
    public function userCanWrite()
    {
        return $this->userIsOwner() && ($this->node->mode() & self::MODE_USER_WRITE);
    }

    /**
     * Checks whether group_id on file is the same as executing user
     *
     * @return bool
     */
    public function groupIsOwner()
    {
        return (bool) ($this->groupid == $this->node->group());
    }

    /**
     * Checks whether file is readable for group
     *
     * @return bool
     */
    public function groupCanRead()
    {
        return $this->groupIsOwner() && ($this->node->mode() & self::MODE_GROUP_READ);
    }

    /**
     * Checks whether file is writable for group
     *
     * @return bool
     */
    public function groupCanWrite()
    {
        return $this->groupIsOwner() && ($this->node->mode() & self::MODE_GROUP_WRITE);
    }

    /**
     * Checks whether file is readable for world
     *
     * @return bool
     */
    public function worldCanRead()
    {
        return (bool) ($this->node->mode() & self::MODE_WORLD_READ);
    }

    /**
     * Checks whether file is writable for world
     *
     * @return bool
     */
    public function worldCanWrite()
    {
        return (bool) ($this->node->mode() & self::MODE_WORLD_WRITE);
    }

    /**
     * Checks whether file is readable (by user, group or world)
     *
     * @return bool
     */
    public function isReadable()
    {
        return $this->userCanRead() || $this->groupCanRead() || $this->worldCanRead();
    }

    /**
     * Checks whether file is writable (by user, group or world)
     *
     * @return bool
     */
    public function isWritable()
    {
        return $this->userCanWrite() || $this->groupCanWrite() || $this->worldCanWrite();
    }

    /**
     * Checks whether userid is 0 - root.
     *
     * @return bool
     */
    public function userIsRoot()
    {
        return $this->userid == 0;
    }

    /**
     * @param \VirtualFileSystem\Structure\Node $node
     *
     * @return PermissionHelper
     */
    public function setNode($node)
    {
        $this->node = $node;

        return $this;
    }
}
