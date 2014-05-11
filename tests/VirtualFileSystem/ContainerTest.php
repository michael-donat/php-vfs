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

        $this->assertEquals($d221, $container->nodeAt('/dir1.2/dir2.1/dir2.2.1'));

    }

    public function testHasNodeAtReturnsCorrectly()
    {

        $container = new Container(new Factory());
        $container->root()->addDirectory(new Directory('dir1.1'));

        $this->assertTrue($container->hasNodeAt('/dir1.1'));
        $this->assertFalse($container->hasNodeAt('/dir'));

    }

    public function testDirectoryCreation()
    {
        $container = new Container(new Factory());
        $container->createDir('/dir1');

        $this->assertInstanceOf('\VirtualFileSystem\Structure\Directory', $container->nodeAt('/dir1'));

        //now recursive
        $container = new Container(new Factory());
        $container->createDir('/dir1/dir2', true);

        $this->assertInstanceOf('\VirtualFileSystem\Structure\Directory', $container->nodeAt('/dir1/dir2'));

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

        $this->assertInstanceOf('\VirtualFileSystem\Structure\File', $container->nodeAt('/file'));

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

        $this->assertTrue($container->hasNodeAt('/file2'), 'File exists at new location.');
        $this->assertFalse($container->hasNodeAt('/file'), 'File does not exist at old location.');
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

        $this->assertTrue($container->hasNodeAt('/dir2'), 'Other parent directories not moved');
        $this->assertTrue($container->hasNodeAt('/dirMoved'), 'Directory moved to new location');
        $this->assertFalse($container->hasNodeAt('/dir1'), 'Directory does not exist at old location');
        $this->assertTrue($container->hasNodeAt('/dirMoved/dir11'), 'Directory child of type Dir moved');
        $this->assertTrue($container->hasNodeAt('/dirMoved/file'), 'Directory child of type File moved');

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

        $this->assertTrue($container->hasNodeAt('/dir2'), 'Other parent directories not moved');
        $this->assertTrue($container->hasNodeAt('/dir2/dirMoved'), 'Directory moved to new location');
        $this->assertFalse($container->hasNodeAt('/dir1'), 'Directory does not exist at old location');
        $this->assertTrue($container->hasNodeAt('/dir2/dirMoved/dir11'), 'Directory child of type Dir moved');
        $this->assertTrue($container->hasNodeAt('/dir2/dirMoved/file'), 'Directory child of type File moved');
    }

    public function testMovingFileOntoExistingFileOverridesTarget()
    {
        $container = new Container(new Factory());
        $container->createFile('/file1', 'file1');
        $container->createFile('/file2', 'file2');

        $container->move('/file1', '/file2');

        $this->assertTrue($container->hasNodeAt('/file2'));
        $this->assertFalse($container->hasNodeAt('/file1'));
        $this->assertEquals('file1', $container->fileAt('/file2')->data());
    }

    public function testMovingDirectoryOntoExistingDirectoryOverridesTarget()
    {
        $container = new Container(new Factory());
        $container->createDir('/dir1');
        $container->createDir('/dir2');

        $container->move('/dir1', '/dir2');

        $this->assertTrue($container->hasNodeAt('/dir2'));
        $this->assertFalse($container->hasNodeAt('/dir1'));
    }

    public function testMovingNonEmptyDirectoryOntoExistingDirectoryFails()
    {
        $container = new Container(new Factory());
        $container->createDir('/dir1');
        $container->createDir('/dir2');
        $container->createFile('/dir2/file1', 'file');

        $this->setExpectedException('\RuntimeException', 'Can\'t override non empty directory.');

        $container->move('/dir1', '/dir2');

    }

    public function testMovingDirectoryOntoExistingFileThrows()
    {
        $container = new Container(new Factory());
        $container->createDir('/dir1');
        $container->createFile('/file2', 'file2');

        $this->setExpectedException('\RuntimeException', 'Can\'t move.');

        $container->move('/dir1', '/file2');

    }

    public function testMovingFileOntoExistingDirectoryThrows()
    {
        $container = new Container(new Factory());
        $container->createDir('/dir1');
        $container->createFile('/file2', 'file2');

        $this->setExpectedException('\RuntimeException', 'Can\'t move.');

        $container->move('/file2', '/dir1');

    }

    public function testMovingFileOntoInvalidPathWithFileParentThrows()
    {
        $container = new Container(new Factory());
        $container->createFile('/file1');
        $container->createFile('/file2', 'file2');

        $this->setExpectedException('VirtualFileSystem\NotDirectoryException');

        $container->move('/file1', '/file2/file1');

    }

    public function testRemoveDeletesNodeFromParent()
    {
        $container = new Container(new Factory());
        $container->createFile('/file');

        $container->remove('/file');

        $this->assertFalse($container->hasNodeAt('/file'), 'File was removed');

        $container->createDir('/dir');

        $container->remove('/dir', true);

        $this->assertFalse($container->hasNodeAt('/dir'), 'Directory was removed');
    }

    public function testRemoveThrowsWhenDeletingDirectoriesWithRecursiveFlag()
    {
        $container = new Container(new Factory());
        $container->createDir('/dir');

        $this->setExpectedException('\RuntimeException', 'Won\'t non-recursively remove directory');

        $container->remove('/dir');
    }

    public function testLinkCreation()
    {
        $container = new Container(new Factory());
        $container->createFile('/file');
        $container->createLink('/link', '/file');

        $this->assertInstanceOf('\VirtualFileSystem\Structure\Link', $container->nodeAt('/link'));

    }

    public function testLinkCreationThrowsWhenTryingToOverride()
    {
        $container = new Container(new Factory());

        $container->createFile('/file');
        $container->createLink('/link', '/file');

        $this->setExpectedException('\RuntimeException');

        $container->createLink('/link', '/file');

    }

    public function testCreatingDirectoryOnPathThrowsWhenParentIsAFile()
    {
        $container = new Container(new Factory());
        $container->createFile('/file');

        $this->setExpectedException('VirtualFileSystem\NotDirectoryException');

        $container->createDir('/file/dir');
    }

    public function testFileAtThrowsWhenFileOnParentPath()
    {
        $container = new Container(new Factory());
        $container->createFile('/file');

        $this->setExpectedException('VirtualFileSystem\NotFoundException');

        $container->nodeAt('/file/file2');
    }

    public function testCreateFileThrowsNonDirWhenParentNotDirectory()
    {
        $container = new Container(new Factory());
        $container->createFile('/file');

        $this->setExpectedException('VirtualFileSystem\NotDirectoryException');

        $container->createFile('/file/file2');
    }

    public function testDirectoryAtThrowsNonDirIfReturnedNotDir()
    {
        $container = new Container(new Factory());
        $container->createFile('/file');

        $this->setExpectedException('VirtualFileSystem\NotDirectoryException');

        $container->directoryAt('/file');
    }

    public function testDirectoryAtBubblesNotFoundOnBadPath()
    {
        $container = new Container(new Factory());

        $this->setExpectedException('VirtualFileSystem\NotFoundException');

        $container->directoryAt('/dir');
    }

    public function testDirectoryAtReturnsDirectory()
    {
        $container = new Container(new Factory());
        $container->createDir('/dir');

        $this->assertInstanceOf('VirtualFileSystem\Structure\Directory', $container->directoryAt('/dir'));
    }

    public function testFileAtThrowsNonFileIfReturnedNotFile()
    {
        $container = new Container(new Factory());
        $container->createDir('/dir');

        $this->setExpectedException('VirtualFileSystem\NotFileException');

        $container->fileAt('/dir');
    }

    public function testFileAtBubblesNotFoundOnBadPath()
    {
        $container = new Container(new Factory());

        $this->setExpectedException('VirtualFileSystem\NotFoundException');

        $container->fileAt('/file');
    }

    public function testFileAtReturnsFile()
    {
        $container = new Container(new Factory());
        $container->createFile('/file');

        $this->assertInstanceOf('VirtualFileSystem\Structure\File', $container->fileAt('/file'));
    }
}
