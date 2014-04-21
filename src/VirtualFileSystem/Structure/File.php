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
     * @return null|string
     */
    public function data()
    {
        return $this->data;
    }

    /**
     * Sets contents.
     *
     * @param $data
     * @param null|string $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}
