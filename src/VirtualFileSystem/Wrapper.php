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
use VirtualFileSystem\Structure\File;
use VirtualFileSystem\Structure\Link;
use VirtualFileSystem\Structure\Root;
use VirtualFileSystem\Wrapper\FileHandler;
use VirtualFileSystem\Wrapper\DirectoryHandler;

/**
 * Stream wrapper class. This is the class that PHP uses as the stream operations handler.
 *
 * @see http://php.net/streamwrapper for informal protocol description
 *
 * @author Michael Donat <michael.donat@me.com>
 * @package php-vfs
 * @api
 */
class Wrapper
{
    public $context;

    /**
     * @var FileHandler
     */
    protected $currentlyOpenedFile;

    /**
     * @var DirectoryHandler
     */
    protected $currentlyOpenedDir;

    /**
     * Returns default expectation for stat() function.
     *
     * @see http://php.net/stat
     *
     * @return array
     */
    protected function getStatArray()
    {
        $assoc = array(
            'dev' => 0,
            'ino' => 0,
            'mode' => 0,
            'nlink' => 0,
            'uid' => 0,
            'gid' => 0,
            'rdev' => 0,
            'size' => 123,
            'atime' => 0,
            'mtime' => 0,
            'ctime' => 0,
            'blksize' => -1,
            'blocks' => -1
        );

        return array_merge(array_values($assoc), $assoc);
    }

    /**
     * Returns path stripped of url scheme (http://, ftp://, test:// etc.)
     *
     * @param string $path
     *
     * @return string
     */
    public function stripScheme($path)
    {
        $scheme = preg_split('#://#', $path, 2);
        $scheme = end($scheme);

        return '/'.ltrim($scheme, '/');
    }

    /**
     * Returns Container object fished form default_context_options by scheme.
     *
     * @param $path
     *
     * @return Container
     */
    public function getContainerFromContext($path)
    {
        $scheme = current(preg_split('#://#', $path));
        $options = stream_context_get_options(stream_context_get_default());

        return $options[$scheme]['Container'];
    }

    /**
     * @see http://php.net/streamwrapper.stream-tell
     *
     * @return int
     */
    public function stream_tell()
    {
        return $this->currentlyOpenedFile->position();
    }

    /**
     * @see http://php.net/streamwrapper.stream-close
     *
     * @return void
     */
    public function stream_close()
    {
        $this->currentlyOpenedFile = null;
    }

    /**
     * Opens stream in selected mode.
     *
     * @see http://php.net/streamwrapper.stream-open
     *
     * @param string $path
     * @param int $mode
     * @param int $options
     *
     * @param $openedPath
     * @throws NotDirectoryException
     * @throws NotFoundException
     * @return bool
     */
    public function stream_open($path, $mode, $options, &$openedPath)
    {
        $container = $this->getContainerFromContext($path);
        $path = $this->stripScheme($path);

        $mode = str_split(str_replace('b', '', $mode));

        $accessDeniedError = function () use ($path, $options) {
            if ($options & STREAM_REPORT_ERRORS) {
                trigger_error(sprintf('fopen(%s): failed to open stream: Permission denied', $path), E_USER_WARNING);
            }

            return false;
        };

        $appendMode = in_array('a', $mode);
        $readMode = in_array('r', $mode);
        $writeMode = in_array('w', $mode);
        $extended = in_array('+', $mode);

        if (!$container->hasNodeAt($path)) {
            if ($readMode or !$container->hasNodeAt(dirname($path))) {
                if ($options & STREAM_REPORT_ERRORS) {
                    trigger_error(sprintf('%s: failed to open stream.', $path), E_USER_WARNING);
                }

                return false;
            }
            $parent = $container->directoryAt(dirname($path));
            $permissionHelper = $container->getPermissionHelper($parent);
            if (!$permissionHelper->isWritable()) {
                return $accessDeniedError();
            }
            $parent->addFile($container->factory()->getFile(basename($path)));
        }

        $file = $container->nodeAt($path);

        if ($file instanceof Link) {
            $file = $file->getDestination();
        }

        if (($extended || $writeMode || $appendMode) && $file instanceof Directory) {
            if ($options & STREAM_REPORT_ERRORS) {
                trigger_error(sprintf('fopen(%s): failed to open stream: Is a directory', $path), E_USER_WARNING);
            }

            return false;
        }

        if ($file instanceof Directory) {
            $dir = $file;
            $file = $container->factory()->getFile('tmp');
            $file->chmod($dir->mode());
            $file->chown($dir->user());
            $file->chgrp($dir->group());
        }

        $permissionHelper = $container->getPermissionHelper($file);

        $this->currentlyOpenedFile = new FileHandler();
        $this->currentlyOpenedFile->setFile($file);

        if ($extended) {
            if (!$permissionHelper->isReadable() or !$permissionHelper->isWritable()) {
                return $accessDeniedError();
            }
            $this->currentlyOpenedFile->setReadWriteMode();
        } elseif ($readMode) {
            if (!$permissionHelper->isReadable()) {
                return $accessDeniedError();
            }
            $this->currentlyOpenedFile->setReadOnlyMode();
        } else { // a or w are for write only
            if (!$permissionHelper->isWritable()) {
                return $accessDeniedError();
            }
            $this->currentlyOpenedFile->setWriteOnlyMode();
        }

        if ($appendMode) {
            $this->currentlyOpenedFile->seekToEnd();
        } elseif ($writeMode) {
            $this->currentlyOpenedFile->truncate();
            clearstatcache();
        }

        $openedPath = $file->path();

        return true;
    }

    /**
     * Writes data to stream.
     *
     * @see http://php.net/streamwrapper.stream-write
     *
     * @param $data
     *
     * @return int
     */
    public function stream_write($data)
    {
        if (!$this->currentlyOpenedFile->isOpenedForWriting()) {
            return false;
        }
        //file access time changes so stat cache needs to be cleared
        $written = $this->currentlyOpenedFile->write($data);
        clearstatcache();

        return $written;
    }

    /**
     * Returns stat data for file inclusion. Currently disabled.
     *
     * @see http://php.net/streamwrapper.stream-stat
     *
     * @return bool
     */
    public function stream_stat()
    {
        return true;
    }

    /**
     * Returns file stat information
     *
     * @see http://php.net/stat
     *
     * @param string $path
     *
     * @return array|bool
     */
    public function url_stat($path)
    {
        try {
            $file = $this->getContainerFromContext($path)->nodeAt($this->stripScheme($path));

            return array_merge($this->getStatArray(), array(
                'mode' => $file->mode(),
                'uid' => $file->user(),
                'gid' => $file->group(),
                'atime' => $file->atime(),
                'mtime' => $file->mtime(),
                'ctime' => $file->ctime()
            ));
        } catch (NotFoundException $e) {
            return false;
        }
    }

    /**
     * Reads and returns $bytes amount of bytes from stream.
     *
     * @see http://php.net/streamwrapper.stream-read
     *
     * @param int $bytes
     *
     * @return string
     */
    public function stream_read($bytes)
    {
        if (!$this->currentlyOpenedFile->isOpenedForReading()) {
            return null;
        }
        $data = $this->currentlyOpenedFile->read($bytes);
        //file access time changes so stat cache needs to be cleared
        clearstatcache();

        return $data;
    }

    /**
     * Checks whether pointer has reached EOF.
     *
     * @see http://php.net/streamwrapper.stream-eof
     *
     * @return bool
     */
    public function stream_eof()
    {
        return $this->currentlyOpenedFile->atEof();
    }

    /**
     * Called in response to mkdir to create directory.
     *
     * @see http://php.net/streamwrapper.mkdir
     *
     * @param string $path
     * @param int    $mode
     * @param int    $options
     *
     * @return bool
     */
    public function mkdir($path, $mode, $options)
    {
        $container = $this->getContainerFromContext($path);
        $path = $this->stripScheme($path);
        $recursive = (bool) ($options & STREAM_MKDIR_RECURSIVE);

        try {
            //need to check all parents for permissions
            $parentPath = $path;
            while ($parentPath = dirname($parentPath)) {
                try {
                    $parent = $container->nodeAt($parentPath);
                    $permissionHelper = $container->getPermissionHelper($parent);
                    if (!$permissionHelper->isWritable()) {
                        trigger_error(sprintf('mkdir: %s: Permission denied', dirname($path)), E_USER_WARNING);

                        return false;
                    }
                    if ($parent instanceof Root) {
                        break;
                    }
                } catch (NotFoundException $e) {
                    break; //will sort missing parent below
                }
            }
            $container->createDir($path, $recursive, $mode);
        } catch (FileExistsException $e) {
            trigger_error($e->getMessage(), E_USER_WARNING);

            return false;
        } catch (NotFoundException $e) {
            trigger_error(sprintf('mkdir: %s: No such file or directory', dirname($path)), E_USER_WARNING);

            return false;
        }

        return true;
    }

    /**
     * Called in response to chown/chgrp/touch/chmod etc.
     *
     * @see http://php.net/streamwrapper.stream-metadata
     *
     * @param string  $path
     * @param int     $option
     * @param integer $value
     *
     * @return bool
     */
    public function stream_metadata($path, $option, $value)
    {
        $container = $this->getContainerFromContext($path);
        $strippedPath = $this->stripScheme($path);

        try {

            if ($option == STREAM_META_TOUCH) {
                if (!$container->hasNodeAt($strippedPath)) {
                    try {
                        $container->createFile($strippedPath);
                    } catch (NotFoundException $e) {
                        trigger_error(
                            sprintf('touch: %s: No such file or directory.', $strippedPath),
                            E_USER_WARNING
                        );

                        return false;
                    }
                }
                $file = $container->nodeAt($strippedPath);

                $permissionHelper = $container->getPermissionHelper($file);

                if (!$permissionHelper->userIsOwner() && !$permissionHelper->isWritable()) {
                    trigger_error(
                        sprintf('touch: %s: Permission denied', $strippedPath),
                        E_USER_WARNING
                    );

                    return false;
                }

                $file->setAccessTime(time());
                $file->setModificationTime(time());
                $file->setChangeTime(time());

                clearstatcache(true, $path);

                return true;

            }

            $node = $container->nodeAt($strippedPath);
            $permissionHelper = $container->getPermissionHelper($node);

            switch ($option) {
                case STREAM_META_ACCESS:

                    if ($node instanceof Link) {
                        $node = $node->getDestination();
                        $permissionHelper = $container->getPermissionHelper($node);
                    }

                    if (!$permissionHelper->userIsOwner()) {
                        trigger_error(
                            sprintf('chmod: %s: Permission denied', $strippedPath),
                            E_USER_WARNING
                        );

                        return false;
                    }
                    $node->chmod($value);
                    $node->setChangeTime(time());
                    break;

                case STREAM_META_OWNER_NAME:
                    if (!$permissionHelper->userIsRoot()) {
                        trigger_error(
                            sprintf('chown: %s: Permission denied', $strippedPath),
                            E_USER_WARNING
                        );

                        return false;
                    }
                    $uid = function_exists('posix_getpwnam') ? posix_getpwnam($value)['uid'] : 0;
                    $node->chown($uid);
                    $node->setChangeTime(time());
                    break;

                case STREAM_META_OWNER:
                    if (!$permissionHelper->userIsRoot()) {
                        trigger_error(
                            sprintf('chown: %s: Permission denied', $strippedPath),
                            E_USER_WARNING
                        );

                        return false;
                    }
                    $node->chown($value);
                    $node->setChangeTime(time());
                    break;

                case STREAM_META_GROUP_NAME:
                    if (!$permissionHelper->userIsRoot()) {
                        trigger_error(
                            sprintf('chgrp: %s: Permission denied', $strippedPath),
                            E_USER_WARNING
                        );

                        return false;
                    }
                    $gid = function_exists('posix_getgrnam') ? posix_getgrnam($value)['gid'] : 0;
                    $node->chgrp($gid);
                    $node->setChangeTime(time());
                    break;

                case STREAM_META_GROUP:
                    if (!$permissionHelper->userIsRoot()) {
                        trigger_error(
                            sprintf('chgrp: %s: Permission denied', $strippedPath),
                            E_USER_WARNING
                        );

                        return false;
                    }
                    $node->chgrp($value);
                    $node->setChangeTime(time());
                    break;
            }
        } catch (NotFoundException $e) {
            return false;
        }

        clearstatcache(true, $path);

        return true;
    }

    /**
     * Sets file pointer to specified position
     *
     * @param int $offset
     * @param int $whence
     *
     * @return bool
     */
    public function stream_seek($offset, $whence = SEEK_SET)
    {
        switch ($whence) {
            case SEEK_SET:
                $this->currentlyOpenedFile->position($offset);
                break;
            case SEEK_CUR:
                $this->currentlyOpenedFile->offsetPosition($offset);
                break;
            case SEEK_END:
                $this->currentlyOpenedFile->seekToEnd();
                $this->currentlyOpenedFile->offsetPosition($offset);
        }

        return true;
    }

    /**
     * Truncates file to given size
     *
     * @param int $newSize
     *
     * @return bool
     */
    public function stream_truncate($newSize)
    {
        $this->currentlyOpenedFile->truncate($newSize);
        clearstatcache();

        return true;
    }

    /**
     * Renames/Moves file
     *
     * @param string $oldname
     * @param string $newname
     *
     * @return bool
     */
    public function rename($oldname, $newname)
    {
        $container = $this->getContainerFromContext($newname);
        $oldname = $this->stripScheme($oldname);
        $newname = $this->stripScheme($newname);

        try {
            $container->move($oldname, $newname);
        } catch (NotFoundException $e) {
            trigger_error(
                sprintf('mv: rename %s to %s: No such file or directory', $oldname, $newname),
                E_USER_WARNING
            );

            return false;
        } catch (\RuntimeException $e) {
            trigger_error(
                sprintf('mv: rename %s to %s: Not a directory', $oldname, $newname),
                E_USER_WARNING
            );

            return false;
        }

        return true;
    }

    /**
     * Deletes file at given path
     *
     * @param int $path
     *
     * @return bool
     */
    public function unlink($path)
    {
        $container = $this->getContainerFromContext($path);

        try {

            $path = $this->stripScheme($path);

            $parent = $container->nodeAt(dirname($path));

            $permissionHelper = $container->getPermissionHelper($parent);
            if (!$permissionHelper->isWritable()) {
                trigger_error(
                    sprintf('rm: %s: Permission denied', $path),
                    E_USER_WARNING
                );

                return false;
            }

            $container->remove($path = $this->stripScheme($path));
        } catch (NotFoundException $e) {
            trigger_error(
                sprintf('rm: %s: No such file or directory', $path),
                E_USER_WARNING
            );

            return false;
        } catch (\RuntimeException $e) {
            trigger_error(
                sprintf('rm: %s: is a directory', $path),
                E_USER_WARNING
            );

            return false;
        }

        return true;
    }

    /**
     * Removes directory
     *
     * @param string $path
     *
     * @return bool
     */
    public function rmdir($path)
    {
        $container = $this->getContainerFromContext($path);
        $path = $this->stripScheme($path);

        try {
            $directory = $container->nodeAt($path);

            if ($directory instanceof File) {
                trigger_error(
                    sprintf('Warning: rmdir(%s): Not a directory', $path),
                    E_USER_WARNING
                );

                return false;
            }

            $permissionHelper = $container->getPermissionHelper($directory);
            if (!$permissionHelper->isReadable()) {
                trigger_error(
                    sprintf('rmdir: %s: Permission denied', $path),
                    E_USER_WARNING
                );

                return false;
            }

        } catch (NotFoundException $e) {
            trigger_error(
                sprintf('Warning: rmdir(%s): No such file or directory', $path),
                E_USER_WARNING
            );

            return false;
        }

        if ($directory->size()) {
            trigger_error(
                sprintf('Warning: rmdir(%s): Directory not empty', $path),
                E_USER_WARNING
            );

            return false;
        }

        $container->remove($path, true);

        return true;
    }

    /**
     * Opens directory for iteration
     *
     * @param string $path
     *
     * @return bool
     */
    public function dir_opendir($path)
    {
        $container = $this->getContainerFromContext($path);

        $path = $this->stripScheme($path);

        if (!$container->hasNodeAt($path)) {
            trigger_error(sprintf('opendir(%s): failed to open dir: No such file or directory', $path), E_USER_WARNING);

            return false;
        }

        try {

            $dir = $container->directoryAt($path);

        } catch (NotDirectoryException $e) {
            trigger_error(sprintf('opendir(%s): failed to open dir: Not a directory', $path), E_USER_WARNING);

            return false;
        }

        $permissionHelper = $container->getPermissionHelper($dir);

        if (!$permissionHelper->isReadable()) {
            trigger_error(sprintf('opendir(%s): failed to open dir: Permission denied', $path), E_USER_WARNING);

            return false;
        }

        $this->currentlyOpenedDir = new DirectoryHandler();
        $this->currentlyOpenedDir->setDirectory($dir);

        return true;
    }

    /**
     * Closes opened dir
     *
     * @return bool
     */
    public function dir_closedir()
    {
        if ($this->currentlyOpenedDir) {
            $this->currentlyOpenedDir = null;

            return true;
        }

        return false;
    }

    /**
     * Returns next file url in directory
     *
     * @return null
     */
    public function dir_readdir()
    {
        $node = $this->currentlyOpenedDir->iterator()->current();
        if (!$node) {
            return false;
        }
        $this->currentlyOpenedDir->iterator()->next();

        return $node->basename();
    }

    /**
     * Resets directory iterator
     */
    public function dir_rewinddir()
    {
        $this->currentlyOpenedDir->iterator()->rewind();
    }

    public function stream_lock($operation)
    {
        return $this->currently_opened->lock($this, $operation);
    }
}
