<?php

namespace VirtualFileSystem\Wrapper;

use VirtualFileSystem\Structure\File;

class FileHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testPointerPositionInitializedToZero()
    {
        $pointer = new FileHandler();

        $this->assertEquals(0, $pointer->position());
    }

    public function testPointerPositionSetterGetter()
    {
        $pointer = new FileHandler();

        $pointer->position(15);
        $this->assertEquals(15, $pointer->position());
    }

    public function testPointerFindsEndOfFile()
    {
        $file = new File('/file');
        $file->setData('1234567');

        $pointer = new FileHandler();
        $pointer->setFile($file);

        $pointer->seekToEnd();

        $this->assertEquals(7, $pointer->position());
    }

    public function testDataIsReadInChunks()
    {
        $file = new File('/file');
        $file->setData('1234567');

        $pointer = new FileHandler();
        $pointer->setFile($file);

        $this->assertEquals('12', $pointer->read(2));
        $this->assertEquals(2, $pointer->position());
        $this->assertEquals('345', $pointer->read(3));
        $this->assertEquals(5, $pointer->position());
        $this->assertEquals('67', $pointer->read(10));
        $this->assertEquals(7, $pointer->position());
    }

    public function testCheckingEOF()
    {
        $file = new File('/file');

        $handler = new FileHandler();
        $handler->setFile($file);

        $this->assertTrue($handler->atEof());

        $file->setData('1');

        $this->assertFalse($handler->atEof());

        $handler->position(1);
        $this->assertTrue($handler->atEof());

        $handler->position(2);
        $this->assertTrue($handler->atEof());

    }

    public function testTruncateRemovesDataAndResetsPointer()
    {

        $file = new File('/file');
        $file->setData('data');

        $handler = new FileHandler();
        $handler->setFile($file);

        $handler->truncate();

        $this->assertEmpty($file->data());
        $this->assertEquals(0, $handler->position());

        //truncate to size
        $file->setData('data--');

        $handler->truncate(4);
        $this->assertEquals(0, $handler->position());
        $this->assertEquals('data', $file->data());

    }

    public function testOffsetPositionMovesPointerCorrectly() {

        $file = new File('/file');
        $file->setData('data');

        $handler = new FileHandler();
        $handler->setFile($file);

        $handler->offsetPosition(2);
        $this->assertEquals(2, $handler->position());

        $handler->offsetPosition(2);
        $this->assertEquals(4, $handler->position());

    }
}
