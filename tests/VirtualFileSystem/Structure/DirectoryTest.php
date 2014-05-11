<?php

namespace VirtualFileSystem\Structure;

class DirectoryTest extends \PHPUnit_Framework_TestCase
{
    public function testThrowsExceptionWhenTryingToCreateAtRoot()
    {
        $this->setExpectedException('\InvalidArgumentException');

        new Directory('/');
    }

    public function testBasename()
    {
        $root = new Root();
        $root->addDirectory($d1 = new Directory('dir1'));
        $root->addDirectory($d2 = new Directory('dir2'));
        $d2->addDirectory($d3 = new Directory('dir3'));

        $this->assertEquals('dir1', $d1->basename());
        $this->assertEquals('dir2', $d2->basename());
        $this->assertEquals('dir3', $d3->basename());
    }

    public function testDirnameBuilding()
    {
        $root = new Root();
        $root->addDirectory($d1 = new Directory('dir1'));
        $root->addDirectory($d2 = new Directory('dir2'));
        $d2->addDirectory($d3 = new Directory('dir3'));

        $this->assertEquals(null, $root->dirname());

        $this->assertEquals('/', $d1->dirname());
        $this->assertEquals('/', $d2->dirname());
        $this->assertEquals('/dir2', $d3->dirname());

    }

    public function testPathBuilding()
    {
        $root = new Root();
        $root->addDirectory($d1 = new Directory('dir1'));
        $root->addDirectory($d2 = new Directory('dir2'));
        $d2->addDirectory($d3 = new Directory('dir3'));

        $this->assertEquals('/dir1', $d1->path());
        $this->assertEquals('/dir2', $d2->path());
        $this->assertEquals('/dir2/dir3', $d3->path());

    }

    public function testChildAtReturnsCorrectNode()
    {
        $root = new Root();
        $root->addDirectory($d1 = new Directory('dir1'));
        $root->addDirectory($d2 = new Directory('dir2'));
        $root->addFile($f1 = new File('file1'));

        $this->assertEquals($d1, $root->childAt('dir1'));
        $this->assertEquals($d2, $root->childAt('dir2'));
        $this->assertEquals($f1, $root->childAt('file1'));
    }

    public function testChildAtThrowsNotFoundWhenInvalidElementRequested()
    {
        $root = new Root();
        $root->addDirectory($d1 = new Directory('dir1'));

        $this->setExpectedException('\VirtualFileSystem\NotFoundException');

        $root->childAt('dir2');
    }

    public function testSizeIsReturnAsNumberOfChildren()
    {
        $root = new Root();
        $root->addDirectory($d1 = new Directory('dir1'));
        $root->addDirectory($d1 = new Directory('dir2'));

        $this->assertEquals(2, $root->size());
    }

    public function testThrowsWhenFileNameClashes()
    {

        $root = new Root();
        $root->addDirectory(new Directory('dir1'));

        $this->setExpectedException('\VirtualFileSystem\FileExistsException');
        $root->addDirectory(new Directory('dir1'));

    }

    public function testRemove()
    {
        $root = new Root();
        $root->addDirectory(new Directory('dir1'));
        $root->remove('dir1');

        $this->setExpectedException('\VirtualFileSystem\NotFoundException');

        $root->childAt('dir1');
    }
}
