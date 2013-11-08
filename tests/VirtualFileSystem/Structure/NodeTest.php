<?php
/**
 * Created by PhpStorm.
 * User: thornag
 * Date: 28/10/2013
 * Time: 20:34
 */

namespace VirtualFileSystem\Structure;

class NodeTest extends \PHPUnit_Framework_TestCase
{
    public function testChmod()
    {
        $file = new File('file');

        $this->assertEquals(Node::DEF_MODE | File::S_IFTYPE, $file->mode());

        $file->chmod(0200);
        $this->assertEquals(0200 | File::S_IFTYPE, $file->mode());

        $file->chmod(0777);
        $this->assertEquals(0777 | File::S_IFTYPE, $file->mode());

    }

    public function testToStringReturnsPath()
    {
        $dir = new Directory('dir');
        $dir->addFile($file = new File('file'));

        $this->assertEquals($file->path(), $file, '__toString() invoked and returned path');

    }

    public function testSizeIsReturned()
    {
        $file = new File('file');
        $file->setData('1234567890');

        $this->assertEquals(10, $file->size());
    }

    public function testURLConstruction()
    {
        $root = new Root();
        $root->setScheme('s://');

        $root->addDirectory($dir = new Directory('dir'));
        $dir->addDirectory($dir = new Directory('dir'));
        $dir->addFile($file = new File('file'));

        $this->assertEquals('s://dir/dir/file', $file->url());
    }
}
