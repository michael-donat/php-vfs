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

use VirtualFileSystem\Structure\File;

/**
 * User as file handle by streamWrapper implementation.
 *
 * This class is responsible mainly for managing the pointer position during reading and writing.
 *
 * @author Michael Donat <michael.donat@me.com>
 * @package php-vfs
 */
class FileHandler
{
    const READ_MODE     = 1;
    const WRITE_MODE    = 2;

    protected $position = 0;

    protected $mode = 0;

    /**
     * @var File
     */
    protected $file;

    /**
     * Sets file in context.
     *
     * @param File $file
     */
    public function setFile(File $file)
    {
        $this->file = $file;
    }

    /**
     * Returns file in context.
     *
     * @return File
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * Writes data to file. Will return the number of bytes written. Will advance pointer by number of bytes written.
     *
     * @param string $data
     *
     * @return int
     */
    public function write($data)
    {
        $content = $this->file->data();
        $content = substr($content, 0, $this->position());
        $content .= $data;
        $this->file->setData($content);
        $written = strlen($data);
        $this->offsetPosition($written);
        $this->file->setModificationTime(time());
        $this->file->setChangeTime(time());

        return $written;
    }

    /**
     * Will read and return $bytes bytes from file. Will advance pointer by $bytes bytes.
     *
     * @param int $bytes
     *
     * @return string
     */
    public function read($bytes)
    {
        $content = $this->file->data();

        $return = substr($content, $this->position(), $bytes);

        $newPosition = $this->position()+$bytes;

        $newPosition = $newPosition > strlen($content) ? strlen($content) : $newPosition;

        $this->position($newPosition);
        $this->file->setAccessTime(time());

        return $return;
    }

    /**
     * Returns current pointer position.
     *
     * @param integer|null $position
     *
     * @return int
     */
    public function position($position = null)
    {
        return is_null($position) ? $this->position : $this->position = $position;
    }

    /**
     * Moves pointer to the end of file (for append modes).
     *
     * @return int
     */
    public function seekToEnd()
    {
        return $this->position(strlen($this->file->data()));
    }

    /**
     * Offsets position by $offset
     *
     * @param int $offset
     */
    public function offsetPosition($offset)
    {
        $this->position += $offset;
    }

    /**
     * Tells whether pointer is at the end of file.
     *
     * @return bool
     */
    public function atEof()
    {
        return $this->position() >= strlen($this->file->data());
    }

    /**
     * Removed all data from file and sets pointer to 0
     *
     * @param int $newSize
     *
     * @return void
     */
    public function truncate($newSize = 0)
    {
        $this->position(0);
        $newData = substr($this->file->data() ?? '', 0, $newSize);
        $newData = false === $newData ? '' : $newData;
        $this->file->setData($newData);
        $this->file->setModificationTime(time());
        $this->file->setChangeTime(time());

        return;
    }

    /**
     * Sets handler to read only
     */
    public function setReadOnlyMode()
    {
        $this->mode = self::READ_MODE;
    }

    /**
     * Sets handler into read/write mode
     */
    public function setReadWriteMode()
    {
        $this->mode = self::READ_MODE | self::WRITE_MODE;
    }

    public function setWriteOnlyMode()
    {
        $this->mode = self::WRITE_MODE;
    }

    /**
     * Checks if pointer allows writing
     *
     * @return bool
     */
    public function isOpenedForWriting()
    {
        return (bool) ($this->mode & self::WRITE_MODE);
    }

    /**
     * Checks if pointer allows reading
     *
     * @return bool
     */
    public function isOpenedForReading()
    {
        return (bool) ($this->mode & self::READ_MODE);
    }

    /**
     * @param  $resource
     */
    public function lock($resource, $operation)
    {
        return $this->file->lock($resource, $operation);
    }
}
