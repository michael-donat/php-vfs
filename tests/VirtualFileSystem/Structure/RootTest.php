<?php

namespace VirtualFileSystem\Structure;

class RootTest extends \PHPUnit\Framework\TestCase
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

        $this->expectException('\LogicException');

        $dir->addDirectory($root);
    }

    public function testRootPathReturnsWithScheme()
    {
        $root = new Root();

        $root->setScheme('scheme://');
        $this->assertEquals('/', $root, 'No scheme when one is set');

    }

    public function testURLIsReturned()
    {

        $root = new Root();

        $root->setScheme('scheme://');
        $this->assertEquals('scheme://', $root->url());

        $root->setScheme('scheme');
        $this->assertEquals('scheme://', $root->url(), 'Scheme reformatted');

    }

    public function testURLThrowsWhenNoScheme()
    {
        $root = new Root();

        $this->expectException('RuntimeException');

        $root->url();
    }

    public function testRootPathReturnsWithoutScheme()
    {
        $root = new Root();

        $this->assertEquals('/', $root);

    }
}
