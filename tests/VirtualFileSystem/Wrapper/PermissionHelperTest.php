<?php

namespace VirtualFileSystem\Wrapper;

use VirtualFileSystem\Structure\File;

class PermissionHelperTest extends \PHPUnit_Framework_TestCase
{
    protected $uid;
    protected $gid;

    public function setUp() {
        $this->uid = function_exists('posix_getuid') ? posix_getuid() : 0;
        $this->gid = function_exists('posix_getgid') ? posix_getgid() : 0;
    }

    public function testUserPermissionsAreCalculatedCorrectly()
    {

        $file = new File('file');
        $file->chown($this->uid);

        $ph = new PermissionHelper();
        $ph->setNode($file);

        $file->chmod(0000);
        $this->assertFalse($ph->userCanRead(), 'User can\'t read with 0000');
        $this->assertFalse($ph->userCanWrite(), 'User can\'t write with 0000');

        $file->chmod(0100);
        $this->assertFalse($ph->userCanRead(), 'User can\'t read with 0100');
        $this->assertFalse($ph->userCanWrite(), 'User can\'t write with 0100');

        $file->chmod(0200);
        $this->assertFalse($ph->userCanRead(), 'User can\'t read with 0200');
        $this->assertTrue($ph->userCanWrite(), 'User can write with 0200');

        $file->chmod(0400);
        $this->assertTrue($ph->userCanRead(), 'User can read with 0400');
        $this->assertFalse($ph->userCanWrite(), 'User can\'t write with 0400');

        $file->chmod(0500);
        $this->assertTrue($ph->userCanRead(), 'User can read with 0500');
        $this->assertFalse($ph->userCanWrite(), 'User can\'t write with 0500');

        $file->chmod(0600);
        $this->assertTrue($ph->userCanRead(), 'User can read with 0600');
        $this->assertTrue($ph->userCanWrite(), 'User can read with 0600');

        $file->chown(1);
        $file->chmod(0666);

        $this->assertFalse($ph->userCanRead(), 'User can\'t read without ownership');
        $this->assertFalse($ph->userCanWrite(), 'User can\'t without ownership');
    }

    public function testGroupPermissionsAreCalculatedCorrectly()
    {
        $file = new File('file');
        $file->chgrp($this->gid);

        $ph = new PermissionHelper();
        $ph->setNode($file);

        $file->chmod(0000);
        $this->assertFalse($ph->groupCanRead(), 'group can\'t read with 0000');
        $this->assertFalse($ph->groupCanWrite(), 'group can\'t write with 0000');

        $file->chmod(0010);
        $this->assertFalse($ph->groupCanRead(), 'group can\'t read with 0010');
        $this->assertFalse($ph->groupCanWrite(), 'group can\'t write with 0010');

        $file->chmod(0020);
        $this->assertFalse($ph->groupCanRead(), 'group can\'t read with 0020');
        $this->assertTrue($ph->groupCanWrite(), 'group can write with 0020');

        $file->chmod(0040);
        $this->assertTrue($ph->groupCanRead(), 'group can read with 0040');
        $this->assertFalse($ph->groupCanWrite(), 'group can\'t write with 0040');

        $file->chmod(0050);
        $this->assertTrue($ph->groupCanRead(), 'group can read with 0050');
        $this->assertFalse($ph->groupCanWrite(), 'group can\'t write with 0050');

        $file->chmod(0060);
        $this->assertTrue($ph->groupCanRead(), 'group can read with 0060');
        $this->assertTrue($ph->groupCanWrite(), 'group can read with 0060');

        $file->chgrp(0);
        $file->chmod(0666);

        $this->assertFalse($ph->groupCanRead(), 'group can\'t read without ownership');
        $this->assertFalse($ph->groupCanWrite(), 'group can\'t without ownership');
    }

    public function testWorldPermissionsAreCalculatedCorrectly()
    {
        $file = new File('file');

        $ph = new PermissionHelper();
        $ph->setNode($file);

        $file->chmod(0000);
        $this->assertFalse($ph->worldCanRead(), 'world can\'t read with 0000');
        $this->assertFalse($ph->worldCanWrite(), 'world can\'t write with 0000');

        $file->chmod(0001);
        $this->assertFalse($ph->worldCanRead(), 'world can\'t read with 0001');
        $this->assertFalse($ph->worldCanWrite(), 'world can\'t write with 0001');

        $file->chmod(0002);
        $this->assertFalse($ph->worldCanRead(), 'world can\'t read with 0002');
        $this->assertTrue($ph->worldCanWrite(), 'world can write with 0002');

        $file->chmod(0004);
        $this->assertTrue($ph->worldCanRead(), 'world can read with 0004');
        $this->assertFalse($ph->worldCanWrite(), 'world can\'t write with 0004');

        $file->chmod(0005);
        $this->assertTrue($ph->worldCanRead(), 'world can read with 0005');
        $this->assertFalse($ph->worldCanWrite(), 'world can\'t write with 0005');

        $file->chmod(0006);
        $this->assertTrue($ph->worldCanRead(), 'world can read with 0006');
        $this->assertTrue($ph->worldCanWrite(), 'world can read with 0006');

    }

    public function testIsReadable()
    {
        $file = new File('file');

        $ph = new PermissionHelper();
        $ph->setNode($file);

        $file->chmod(0000);
        $file->chown(0);
        $file->chgrp(0);
        $this->assertFalse($ph->isReadable(), 'File is not readable root:root 0000');

        $file->chmod(0400);
        $file->chown(0);
        $file->chgrp(0);
        $this->assertFalse($ph->isReadable(), 'File is not readable root:root 0400');

        $file->chmod(0040);
        $file->chown(0);
        $file->chgrp(0);
        $this->assertFalse($ph->isReadable(), 'File is not readable root:root 0040');

        $file->chmod(0004);
        $file->chown(0);
        $file->chgrp(0);
        $this->assertTrue($ph->isReadable(), 'File is readable root:root 0004');

        $file->chmod(0000);
        $file->chown($this->uid);
        $file->chgrp(0);
        $this->assertFalse($ph->isReadable(), 'File is not readable user:root 0000');

        $file->chmod(0400);
        $file->chown($this->uid);
        $file->chgrp(0);
        $this->assertTrue($ph->isReadable(), 'File is readable user:root 0400');

        $file->chmod(0040);
        $file->chown($this->uid);
        $file->chgrp(0);
        $this->assertFalse($ph->isReadable(), 'File is not readable user:root 0040');

        $file->chmod(0004);
        $file->chown($this->uid);
        $file->chgrp(0);
        $this->assertTrue($ph->isReadable(), 'File is readable user:root 0004');

        $file->chmod(0000);
        $file->chown(0);
        $file->chgrp($this->gid);
        $this->assertFalse($ph->isReadable(), 'File is not readable root:user 0000');

        $file->chmod(0040);
        $file->chown(0);
        $file->chgrp($this->gid);
        $this->assertTrue($ph->isReadable(), 'File is readable root:user 0040');

        $file->chmod(0400);
        $file->chown(0);
        $file->chgrp($this->gid);
        $this->assertFalse($ph->isReadable(), 'File is not readable root:user 0400');

        $file->chmod(0004);
        $file->chown(0);
        $file->chgrp($this->gid);
        $this->assertTrue($ph->isReadable(), 'File is readable root:user 0004');
    }
}
