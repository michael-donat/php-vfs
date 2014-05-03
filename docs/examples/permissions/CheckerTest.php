<?php

require_once 'Checker.php';

class CheckerWithMockTest extends PHPUnit_Framework_TestCase {

    public function testCheckingForCacheReturnsWritableState()
    {
        $fs = new \VirtualFileSystem\FileSystem();
        $checker = new Checker($fs->path('/'));

        $this->assertFalse($checker->checkCache());

        $fs->createDirectory('/cache');

        chmod($fs->path('/cache'), 0000);
        $this->assertFalse($checker->checkCache());

        chmod($fs->path('/cache'), 0700);

        $this->assertTrue($checker->checkCache());
    }
}


class CheckerTest extends PHPUnit_Framework_TestCase {

    public function testCheckingForCacheReturnsWritableState()
    {
        mkdir($root = '/tmp/'.uniqid());

        $checker = new Checker($root);

        $this->assertFalse($checker->checkCache());

        mkdir($cache = $root.'/cache');

        chmod($cache, 0000);
        $this->assertFalse($checker->checkCache());

        chmod($cache, 0700);

        $this->assertTrue($checker->checkCache());

        rmdir($cache);
        rmdir($root);
    }
}