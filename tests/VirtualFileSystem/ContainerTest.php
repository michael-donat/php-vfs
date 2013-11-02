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

    public function testHasFileAtReturnsCorrectly() {

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
}
