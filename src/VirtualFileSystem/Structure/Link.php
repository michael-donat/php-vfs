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
 * Object representation of a Link.
 *
 * @author Michael Donat <michael.donat@me.com>
 * @package php-vfs
 */
class Link extends Node
{
    /**
     * @see http://man7.org/linux/man-pages/man2/lstat.2.html
     */
    const S_IFTYPE   = 0120000;

    /**
     * @var Node
     */
    protected $destination;

    /**
     * Class constructor.
     *
     * @param string $basename
     */
    public function __construct($basename, Node $destination)
    {
        parent::__construct($basename);
        $this->destination = $destination;
    }

    /**
     * Returns Link size.
     *
     * The size is the length of the destination path
     *
     * @return mixed
     */
    public function size()
    {
        return $this->destination->size();
    }

    /**
     * @return Node
     */
    public function getDestination()
    {
        return $this->destination;
    }
}
