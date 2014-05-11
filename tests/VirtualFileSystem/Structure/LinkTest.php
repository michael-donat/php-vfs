<?php

namespace VirtualFileSystem\Structure;

class LinkTest extends \PHPUnit_Framework_TestCase
{
    public function testFileSizeAssumesTargetSize()
    {
        $node = new File('file');
        $node->setData('12345');

        $link = new Link('link', $node);

        $this->assertEquals($node->size(), $link->size());

        $dir = new Directory('/d');

        new Link('link', $dir);

        $this->assertEquals($dir->size(), $dir->size());

        $dir->addFile($node);

        $this->assertEquals($dir->size(), $dir->size());
    }
}
