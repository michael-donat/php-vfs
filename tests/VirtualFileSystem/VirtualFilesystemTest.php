<?php

namespace VirtualFileSystem;

class VirtualFilesystemTest extends \PHPUnit\Framework\TestCase
{
    public function testContainerIsSetDuringConstruction()
    {
        $fs = new FileSystem();

        $this->assertInstanceOf('\VirtualFilesystem\Container', $fs->container());
        $this->assertInstanceOf('\VirtualFilesystem\Structure\Root', $fs->root());
    }

    public function testFactoryIsSetDuringConstruction()
    {
        $fs = new FileSystem();

        $this->assertInstanceOf('\VirtualFilesystem\Factory', $fs->container()->factory());
    }

    public function testWrapperIsRegisteredDuringObjectLifetime()
    {
        $fs = new FileSystem();
        $scheme = $fs->scheme();

        $this->assertTrue(in_array($scheme, stream_get_wrappers()), 'Wrapper registered in __construct()');

        unset($fs); //provoking __destruct
        $this->assertFalse(in_array($scheme, stream_get_wrappers()), 'Wrapper unregistered in __destruct()');
    }

    public function testFilesystemFactoryAddedToDefaultContextDuringObjectLifetime()
    {
        $fs = new FileSystem();
        $scheme = $fs->scheme();

        $options = stream_context_get_options(stream_context_get_default());

        $this->assertArrayHasKey($scheme, $options, 'Wrraper key registered in context');
        $this->assertArrayHasKey('Container', $options[$scheme], 'Container registered in context key');

        //can't find a way to unset default context yet
        //unset($fs); //provoking __destruct
        //$options = stream_context_get_options(stream_context_get_default());
        //$this->assertArrayNotHasKey('anotherVFSwrapper', $options, 'Wrraper key not registered in context');

    }

    public function testDefaultContextOptionsAreExtended()
    {
        stream_context_set_default(array('someContext' => array('a' => 'b')));

        $fs = new FileSystem();
        $scheme = $fs->scheme();

        $options = stream_context_get_options(stream_context_get_default());

        $this->assertArrayHasKey($scheme, $options, 'FS Context option present');
        $this->assertArrayHasKey('someContext', $options, 'Previously existing context option present');

    }

    public function testSetStreamNameViaEnvironmentVariable()
    {
        $_ENV['PHPVFS_NAME'] = 'vfs';

        $fs = new FileSystem();
        $fs->createFile('/foo.txt', 'This is the content of foo.txt');

        $this->assertEquals('vfs://foo.txt', $fs->path('foo.txt'));

        unset($_ENV['PHPVFS_NAME']);
    }

    public function testCreateDirectoryCreatesDirectories()
    {
        $fs = new FileSystem();

        $directory = $fs->createDirectory('/dir/dir', true);

        $this->assertInstanceOf('\VirtualFileSystem\Structure\Directory', $directory);
        $this->assertEquals('/dir/dir', $directory->path());
    }

    public function testCreateFileCreatesFile()
    {
        $fs = new FileSystem();

        $file = $fs->createFile('/file', 'data');

        $this->assertInstanceOf('\VirtualFileSystem\Structure\File', $file);
        $this->assertEquals('/file', $file->path());
        $this->assertEquals('data', $file->data());
    }

    public function testCreateStuctureMirrorsStructure()
    {
        $fs = new FileSystem();
        $fs->createStructure(['file' => 'omg', 'file2' => 'gmo']);

        $file = $fs->container()->fileAt('/file');
        $file2 = $fs->container()->fileAt('/file2');

        $this->assertEquals('omg', $file->data());
        $this->assertEquals('gmo', $file2->data());

        $fs->createStructure(['dir' => [], 'dir2' => []]);

        $dir = $fs->container()->nodeAt('/dir');
        $dir2 = $fs->container()->nodeAt('/dir2');

        $this->assertInstanceOf('VirtualFileSystem\Structure\Directory', $dir);
        $this->assertInstanceOf('VirtualFileSystem\Structure\Directory', $dir2);

        $fs->createStructure([
            'dir3' => [
                'file' => 'nested',
                'dir4' => [
                    'dir5' => [
                        'file5' => 'nestednested'
                    ]
                ]
            ]
        ]);

        $dir = $fs->container()->directoryAt('/dir3');

        $this->assertInstanceOf('VirtualFileSystem\Structure\Directory', $dir);

        $file = $fs->container()->fileAt('/dir3/file');

        $this->assertEquals('nested', $file->data());

        $dir = $fs->container()->directoryAt('/dir3/dir4/dir5');

        $this->assertInstanceOf('VirtualFileSystem\Structure\Directory', $dir);

        $file = $fs->container()->fileAt('/dir3/dir4/dir5/file5');

        $this->assertEquals('nestednested', $file->data());
    }
}
