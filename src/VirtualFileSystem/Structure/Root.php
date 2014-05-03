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
 * FileSystem Root representation.
 *
 * Specialised Directory that does not allow for basename or parent setting.
 *
 * @author Michael Donat <michael.donat@me.com>
 * @package php-vfs
 */
class Root extends Directory
{
    const BASENAME = '/';
    protected $scheme;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->basename = self::BASENAME;
        $this->chmod(static::DEF_MODE);
    }

    /**
     * Defined to prevent setting parent on Root.
     *
     * @param Directory $parent
     *
     * @throws \LogicException
     */
    protected function setParent(Directory $parent)
    {
        throw new \LogicException('Root cannot have a parent.');
    }

    /**
     * Set root scheme for use in path method.
     *
     * @param string $scheme
     */
    public function setScheme($scheme)
    {
        list($scheme) = explode(':', $scheme);
        $this->scheme = $scheme.'://';
    }

    /**
     * Returns URL to file.
     *
     * @return string
     */
    public function path()
    {
        return '/';
    }

    public function url()
    {
        if (!$this->scheme) {
            throw new \RuntimeException('No scheme set');
        }

        return $this->scheme;
    }
}
