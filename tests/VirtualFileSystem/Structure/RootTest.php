<?php

namespace VirtualFileSystem\Structure;

class RootTest extends \PHPUnit_Framework_TestCase
{
    public function testBaseName()
    {
        $root = new Root();
        $this->assertEquals('/', $root->basename());
    }

    public function testPath()
    {
        $root = new Root();
        $this->assertEquals('/', $root->path());
    }

    public function testDirname()
    {
        $root = new Root();
        $this->assertEquals('', $root->dirname());
    }

    public function testThrowsWhenTryingToSetParent()
    {
        $root = new Root();
        $dir = new Directory('a');

        $this->setExpectedException('\LogicException');

        $dir->addDirectory($root);
    }

    public function testRootPathReturnsWithScheme()
    {
        $root = new Root();

        $root->setScheme('scheme://');
        $this->assertEquals('scheme://', $root);

        $root->setScheme('scheme');
        $this->assertEquals('scheme://', $root, 'Scheme is properly reformatted');

    }

    public function testRootPathReturnsWithoutScheme()
    {
        $root = new Root();

        $this->assertEquals('/', $root);

    }
}
