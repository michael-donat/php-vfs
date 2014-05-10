|Build status|Coverage|Last stable|Last development|
|:-------------:|:-------------:|:-----:|:-----:|
|[![Build Status](https://travis-ci.org/thornag/php-vfs.png)](https://travis-ci.org/thornag/php-vfs)|[![Coverage Status](https://coveralls.io/repos/thornag/php-vfs/badge.png?branch=master)](https://coveralls.io/r/thornag/php-vfs?branch=master)|[![Latest Stable Version](https://poser.pugx.org/php-vfs/php-vfs/v/stable.png)](https://packagist.org/packages/php-vfs/php-vfs)|[![Latest Unstable Version](https://poser.pugx.org/php-vfs/php-vfs/v/unstable.png)](https://packagist.org/packages/php-vfs/php-vfs)|

php-vfs
========

Very simple filesystem emulating PHP stream wrapper for use in unit testing
with PHPUnit, PHPSpec or any other testing framework. It offers means to test methods interacting
with real filesystem without creating temporary directories or file fixtures.

Released under a GPL3+ licence.

For latest release please use tag indicated above.

Prerequisites
-------------

PHP >= 5.4.0


Installation
------------

**Composer**

Add a dev dependency on php-vfs/php-vfs to your project's composer.json

    {
        "require-dev": {
            "php-vfs/php-vfs": "*@stable"
        }
    }

Or via command line:

    composer require --dev php-vfs/php-vfs=*@stable

This will install latest stable version of php-vfs as a development dependency, for the latest development version replace @stable with @dev.

**PEAR**

php-vfs is hosted on pear.michaeldonat.net and can be installed using following commands:

    sudo pear channel-discover pear.michaeldonat.net
    sudo pear install pear.michaeldonat.net/VirtualFileSystem
    
To use PEAR installation with your testing framework you need to initialize the autoloader in your bootsrtap files.

```PHP
require_once 'VirtualFileSystem/Loader.php';
$l = new \VirtualFileSystem\Loader();
$l->register();
```
	
Usage
--------------

Let's assume we need to test a class that reads CSV file and provides SUM() of columns. The unit test class would normally look something similar to following:

```PHP
class CSVTest extends \PHPUnit_Framework_TestCase {

    public function test_sumIsCorrectlyCalculated()
    {
        $csv = new CSV('fixtures/sum.csv');

        $this->assertEquals(10, $csv->getColumnSum(1), 'Sum of first column is 10');
        $this->assertEquals(15, $csv->getColumnSum(2), 'Sum of first column is 15');
    }
}
```

And the CSV file would look something like:

```
"Column 1","Column 2"
5,5
4,7
1,3
```

And our CSV class:

```PHP
class CSV {

    protected $data = array();

    public function __construct($file)
    {
        if (false === ($handle = fopen($file, "r"))) {
            throw new \RuntimeException('Could not read input file: ' . $file);
        }

        while (false !== ($data = fgetcsv($handle, 1024))) {
            $this->data[] = $data;
        }

        fclose($handle);
    }

    public function getColumnSum($column)
    {
        $toSum = array();
        foreach ($this->data as $line) {
            $toSum[] = $line[$column];
        }

        return array_sum($toSum);
    }

}
```

While above works, providing fixture file to be able to test is somewhat not in line with unit testing principles; it creates dependency on filesystem.
We could possibly create the file in our setUp method and then clear it in tearDown, but if the test fails and tearDown is never executed we will leave
 garbage behind, and we didn't even consider a situation when we don't have permissions to the file system and so on. The other option is to create fixture and keep
 it together with source files. While this approach is widely used it does mean that if someone changes that fixture your test will fail.

 The solution is to create our file in memory - this is when php-vfs comes into play.

 Let's consider slightly reworked unit test:

```PHP
use VirtualFileSystem\FileSystem;

class CSVTest extends \PHPUnit_Framework_TestCase {

    protected $csvData = array(
        '"Column 1";"Column 2"',
        '5,5',
        '4,7',
        '1,3'
    );

    public function test_sumIsCorrectlyCalculated()
    {
        $fs = new FileSystem();

        file_put_contents($fs->path('/sum.csv'), join(PHP_EOL, $this->csvData));

        $csv = new CSV($fs->path('/sum.csv'));

        $this->assertEquals(10, $csv->getColumnSum(1), 'Sum of first column is 10');
        $this->assertEquals(15, $csv->getColumnSum(2), 'Sum of first column is 15');
    }
}
```

As you can see there is no fixture or file created by our test that could be otherwise left behind. We can control the file contents and existence within the
scope of our unit test, thus keeping our test background/environment isolated from external changes.

API
--------------

While using low level API for interaction with php-vfs is at its core, a much easier approach is to mock filesystem using provided interface.

There are generally 2 methods you should always use when mocking up the state:

- ```\VirtualFileSystem\FileSystem::createDirectory($path, $recursive, $mode)``` used to mock directory;
- ```\VirtualFileSystem\FileSystem::createFile($path, $data)``` used to mock file and its contents.
- ```\VirtualFileSystem\FileSystem::createLink($linkPath, $targetPath)``` used to mock symlink.
- ```\VirtualFileSystem\FileSystem::createStructure(array $structure)``` used to mock filesystem from array.

Combining above 2 should allow you to recreate any directory/file structure.

Full API documentation is available [here](http://thornag.github.io/php-vfs/api/master).

Behaviour
-------------

php-vfs tries to mimic unix filesystem as much as possible. The same conditions must be matched and the same errors will be triggered as if we were interacting via php with real underlying filesystem.

Most of [PHP filesystem functions](http://www.php.net/manual/en/ref.filesystem.php) are happily supported by php-vfs as long as the full file URL is passed as argument (using ```$fs->path()```). If you find something not working and not listed below please rise an issue on [github issues page](https://github.com/thornag/php-vfs/issues).

**Known pitfalls**

streamWrapper implementations like php-vfs will not work with glob methods for directory iteration - you need to use ```DirectoryIterator``` or ```readdir()``` instead.

Contributing
----------------

Any contributions are more than welcome. Please make sure that you keep to [PSR-2](http://www.php-fig.org/psr/psr-2/) standards and provide tested code.

You are more than welcome to add yourself to CONTRIBUTORS.md.

Changes in 1.1.0
----------------

For full diff of changes please go to https://github.com/thornag/php-vfs/compare/v1.0.0...1.1.x

- added support for symlinks
- fixed Windows compatibility issues
- provided method to recreate dir/file structure from array [createStructure method]
- added permission support where it was previously not available (touch etc)

