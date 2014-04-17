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

/**
 * Abstract class to represent filesystem Node.
 *
 * @author Michael Donat <michael.donat@me.com>
 * @package php-vfs
 */
abstract class Node
{
    const S_IFMT    = 0160000;
    const DEF_MODE  = 0755;

    protected $basename;
    protected $parent;
    protected $userid;
    protected $groupid;

    protected $atime;
    protected $mtime;
    protected $ctime;


    /**
     * Class constructor.
     *
     * @param string $basename
     */
    public function __construct($basename)
    {
        $this->basename = $basename;
        $this->chmod(self::DEF_MODE);
    }

    /**
     * Changes access to file.
     *
     * This will apply the DIR/FILE type mask for use by stat to distinguish between file and directory.
     * @see http://man7.org/linux/man-pages/man2/lstat.2.html for explanation.
     *
     * @param int $mode
     */
    public function chmod($mode)
    {
        $this->mode = $mode | static::S_IFTYPE;
    }

    /**
     * Returns file mode
     *
     * @return int
     */
    public function mode()
    {
        return $this->mode;
    }

    /**
     * Changes ownership.
     *
     * @param $userid
     */
    public function chown($userid)
    {
        $this->userid = $userid;
    }

    /**
     * Returns ownership.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->userid;
    }

    /**
     * Changes group ownership.
     *
     * @param $groupid
     */
    public function chgrp($groupid)
    {
        $this->groupid = $groupid;
    }

    /**
     * Returns group ownership.
     *
     * @return mixed
     */
    public function group()
    {
        return $this->groupid;
    }

    /**
     * Returns Node size.
     *
     * @return mixed
     */
    abstract public function size();

    /**
     * Sets parent Node.
     *
     * @param Directory $parent
     */
    protected function setParent(Directory $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Returns Node basename.
     *
     * @return string
     */
    public function basename()
    {
        return $this->basename;
    }

    /**
     * Sets new basename
     *
     * @param string $basename
     */
    public function setBasename($basename)
    {
        $this->basename = $basename;
    }

    /**
     * Returns node path.
     *
     * @return string
     */
    public function path()
    {
        $dirname = $this->dirname();

        if ($this->parent instanceof Root) { //at root

            return $dirname.$this->basename();
        }

        return sprintf('%s/%s', $dirname, $this->basename());

    }

    /**
     * Returns node URL.
     *
     * @return string
     */
    public function url()
    {
        $dirname = $this->parent->url();

        if ($this->parent instanceof Root) { //at root

            return $dirname.$this->basename();
        }

        return sprintf('%s/%s', $dirname, $this->basename());

    }

    /**
     * Returns node absolute path (without scheme).
     *
     * @return string
     */
    public function __toString()
    {
        return $this->path();
    }

    /**
     * Returns Node parent absolute path.
     *
     * @return string|null
     */
    public function dirname()
    {
        if ($this->parent) {
            return $this->parent->path();
        }
    }

    /**
     * Sets last access time
     *
     * @param int $time
     */
    public function setAccessTime($time)
    {
        $this->atime = $time;
    }

    /**
     * Sets last modification time
     *
     * @param int $time
     */
    public function setModificationTime($time)
    {
        $this->mtime = $time;
    }

    /**
     * Sets last inode change time
     *
     * @param int $time
     */
    public function setChangeTime($time)
    {
        $this->ctime = $time;
    }

    /**
     * Returns last access time
     *
     * @return int
     */
    public function atime()
    {
        return $this->atime;
    }

    /**
     * Returns last modification time
     *
     * @return int
     */
    public function mtime()
    {
        return $this->mtime;
    }

    /**
     * Returns last inode change time (chown etc.)
     *
     * @return int
     */
    public function ctime()
    {
        return $this->ctime;
    }
}
