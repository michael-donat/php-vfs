<?php

namespace VirtualFileSystem;

use VirtualFileSystem\Structure\Root;
use VirtualFileSystem\Structure\Directory;
use VirtualFileSystem\Structure\File;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testRootCreatedAfterRegistration()
    {
        $container = new Container(new Factory());

        $this->assertInstanceOf('\VirtualFileSystem\Structure\Root', $container->root());
        $this->assertEquals('/', $container->root()->basename());
        $this->assertEquals('/', $container->root()->path());

    }

    public function testNodeAtAddressReturned()
    {
        $container = new Container(new Factory());
        $container->root()->addDirectory(new Directory('dir1.1'));
        $container->root()->addDirectory($d12 = new Directory('dir1.2'));

        $d12->addDirectory($d21 = new Directory('dir2.1'));
        $d21->addDirectory($d221 = new Directory('dir2.2.1'));
        $d221->addFile($file = new File('testFile'));

        $this->assertEquals($d221, $container->fileAt('/dir1.2/dir2.1/dir2.2.1'));

    }

    public function testHasFileAtReturnsCorrectly()
    {

        $container = new Container(new Factory());
        $container->root()->addDirectory(new Directory('dir1.1'));

        $this->assertTrue($container->hasFileAt('/dir1.1'));
        $this->assertFalse($container->hasFileAt('/dir'));

    }

    public function testDirectoryCreation()
    {
        $container = new Container(new Factory());
        $container->createDir('/dir1');

        $this->assertInstanceOf('\VirtualFileSystem\Structure\Directory', $container->fileAt('/dir1'));

        //now recursive
        $container = new Container(new Factory());
        $container->createDir('/dir1/dir2', true);

        $this->assertInstanceOf('\VirtualFileSystem\Structure\Directory', $container->fileAt('/dir1/dir2'));

        //and mode
        $container = new Container(new Factory());
        $dir = $container->createDir('/dir1/dir2/dir3', true, 0000);

        $this->assertEquals(0000 | Directory::S_IFTYPE, $dir->mode());

    }

    public function testMkdirThrowsWhenNoParent()
    {
        $this->setExpectedException('\VirtualFilesystem\NotFoundException');

        $container = new Container(new Factory());
        $container->createDir('/dir1/dir2');

    }

    public function testFileCreation()
    {
        $container = new Container(new Factory());

        $container->createFile('/file');

        $this->assertInstanceOf('\VirtualFileSystem\Structure\File', $container->fileAt('/file'));

        //with content

        $container->createFile('/file2', 'someData');

        $this->assertEquals('someData', $container->fileAt('/file2')->data());

    }

    public function testFileCreationThrowsWhenNoParent()
    {
        $this->setExpectedException('\VirtualFilesystem\NotFoundException');

        $container = new Container(new Factory());

        $container->createFile('/dir/file');

    }

    public function testFileCreationThrowsWhenTryingToOverride()
    {
        $container = new Container(new Factory());

        $container->createFile('/file');

        $this->setExpectedException('\RuntimeException');

        $container->createFile('/file');

    }

    public function testMovingFilesWithinParent()
    {
        $container = new Container(new Factory());
        $container->createFile('/file');

        $container->move('/file', '/file2');

        $this->assertTrue($container->hasFileAt('/file2'), 'File exists at new location.');
        $this->assertFalse($container->hasFileAt('/file'), 'File does not exist at old location.');
    }

    public function testMovingDirectoriesWithinParent()
    {
        $container = new Container(new Factory());
        $container->root()->addDirectory($dir = new Directory('dir1'));
        $container->root()->addDirectory(new Directory('dir2'));
        $dir->addDirectory(new Directory('dir11'));
        $dir->addDirectory(new Directory('dir12'));
        $dir->addFile(new File('file'));

        $container->move('/dir1', '/dirMoved');

        $this->assertTrue($container->hasFileAt('/dir2'), 'Other parent directories not moved');
        $this->assertTrue($container->hasFileAt('/dirMoved'), 'Directory moved to new location');
        $this->assertFalse($container->hasFileAt('/dir1'), 'Directory does not exist at old location');
        $this->assertTrue($container->hasFileAt('/dirMoved/dir11'), 'Directory child of type Dir moved');
        $this->assertTrue($container->hasFileAt('/dirMoved/file'), 'Directory child of type File moved');

    }

    public function testMovingToDifferentParent()
    {
        $container = new Container(new Factory());
        $container->root()->addDirectory($dir = new Directory('dir1'));
        $container->root()->addDirectory(new Directory('dir2'));
        $dir->addDirectory(new Directory('dir11'));
        $dir->addDirectory(new Directory('dir12'));
        $dir->addFile(new File('file'));

        $container->move('/dir1', '/dir2/dirMoved');

        $this->assertTrue($container->hasFileAt('/dir2'), 'Other parent directories not moved');
        $this->assertTrue($container->hasFileAt('/dir2/dirMoved'), 'Directory moved to new location');
        $this->assertFalse($container->hasFileAt('/dir1'), 'Directory does not exist at old location');
        $this->assertTrue($container->hasFileAt('/dir2/dirMoved/dir11'), 'Directory child of type Dir moved');
        $this->assertTrue($container->hasFileAt('/dir2/dirMoved/file'), 'Directory child of type File moved');
    }

    public function testMovingOntoDirectoryMovesIntoThatDirectory()
    {
        $container = new Container(new Factory());
        $container->root()->addDirectory($dir = new Directory('dir1'));
        $container->root()->addDirectory(new Directory('dir2'));
        $dir->addDirectory(new Directory('dir11'));
        $dir->addDirectory(new Directory('dir12'));
        $dir->addFile(new File('file'));

        $container->move('/dir1', '/dir2');

        $this->assertTrue($container->hasFileAt('/dir2'), 'Other parent directories not moved');
        $this->assertTrue($container->hasFileAt('/dir2/dir1'), 'Directory moved to new location');
        $this->assertFalse($container->hasFileAt('/dir1'), 'Directory does not exist at old location');
        $this->assertTrue($container->hasFileAt('/dir2/dir1/dir11'), 'Directory child of type Dir moved');
        $this->assertTrue($container->hasFileAt('/dir2/dir1/file'), 'Directory child of type File moved');
        $this->assertEquals('/dir2/dir1', $dir->path(), 'Moved dir has correct ancestors.');

        $container->move('/dir2/dir1/file', '/dir2/');

        $this->assertTrue($container->hasFileAt('/dir2/file'));

        $container->move('/dir2/file', '/');

        $this->assertTrue($container->hasFileAt('/file'));

    }

    public function testMovingFileOntoExistingFileOverridesTarget()
    {
        $container = new Container(new Factory());
        $container->createFile('/file1', 'file1');
        $container->createFile('/file2', 'file2');

        $container->move('/file1', '/file2');

        $this->assertTrue($container->hasFileAt('/file2'));
        $this->assertFalse($container->hasFileAt('/file1'));
        $this->assertEquals('file1', $container->fileAt('/file2')->data());
    }

    public function testMovingDirectoryOntoExistingFileThrows()
    {
        $container = new Container(new Factory());
        $container->createDir('/dir1');
        $container->createFile('/file2', 'file2');

        $this->setExpectedException('\RuntimeException', 'Can\'t move directory onto a file');

        $container->move('/dir1', '/file2');

    }

    public function testRemoveDeletesNodeFromParent()
    {
        $container = new Container(new Factory());
        $container->createFile('/file');

        $container->remove('/file');

        $this->assertFalse($container->hasFileAt('/file'), 'File was removed');

        $container->createDir('/dir');

        $container->remove('/dir', true);

        $this->assertFalse($container->hasFileAt('/dir'), 'Directory was removed');
    }

    public function testRemoveThrowsWhenDeletingDirectoriesWithRecursiveFlag()
    {
        $container = new Container(new Factory());
        $container->createDir('/dir');

        $this->setExpectedException('\RuntimeException', 'Won\'t non-recursively remove directory');

        $container->remove('/dir');
    }

    public function testCreatingDirectoryOnPathThrowsWhenParentIsAFile()
    {
        $container = new Container(new Factory());
        $container->createFile('/file');

        $this->setExpectedException('VirtualFileSystem\NotDirectoryException');

        $container->createDir('/file/dir');
    }
}
