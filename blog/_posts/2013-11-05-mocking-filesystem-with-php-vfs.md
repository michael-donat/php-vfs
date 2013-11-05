---
layout: post
title: "Mocking filesystem with php-vfs"
description: "How to mock filesystem while unit testing."
category: "Testing"
tags: [mocking filesystem vfs unit testing]
---
{% include JB/setup %}


Many times when developing I came across a situation where there is some sort of filesystem (later 'fs') functionality
required, be it cache generation, reports, compiling configuration or user directories creation there will be lines of
code responsible for delivering that and these should be tested as well as any other part of the system.

The problem with PHP is that pretty much all of the fs functions are within the low level API and can't be easily injected as dependency
and mocked in your test. Ever since PHP 4 there has been quite good support for stream wrappers and we have the ability
to create our own - this ability is exactly what allows us to mock filesystem in a way that can be easily used within
unit test.

You may ask why even bother if you can simply use fixtures or temporary directories? Well, the answer really is because
using underlying fs creates dependency on that fs and a unit test with dependency isn't really a unit, is it? The fact is
that there will always be questions and things going wrong when using real fs. Do you have permissions, what
if some other parallel test modifies the fixture, what if the test fails to complete and we never clear temporary files?

Answers to above questions triggered me to start looking for a different alternative, one where I don't have to think
about the environment the test will be run in and I don't have to worry about the configuration of such environment
allows me to create temporary directories/files.

This is how I first encountered the vfsStream implementation by bovigo. The idea was great but the execution, I thought, a bit dated.
The wrapper in vfsStream is registered via static method and is global to the process, package interfaces are all over the
place and the whole thing has somewhat PHP4-esque feel.

I decided to deliver something that will offer the same if not more functionality, be structured better and thus easier to adapt - enter php-vfs.

Let's assume we need to test a class that reads CSV file and provides SUM() of columns. The unit test class would normally look something similar to following:


    class CSVTest extends \PHPUnit_Framework_TestCase {

        public function test_sumIsCorrectlyCalculated()
        {
            $csv = new CSV('fixtures/sum.csv');

            $this->assertEquals(10, $csv->getColumnSum(1), 'Sum of first column is 10');
            $this->assertEquals(15, $csv->getColumnSum(2), 'Sum of first column is 15');
        }
    }

And the CSV file would look something like:

    "Column 1","Column 2"
    5,5
    4,7
    1,3


And our CSV class:


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


 Let's consider slightly reworked unit test using php-vfs:


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


As you can see the dependency on underlying fs has been removed and the unit test is run in full isolation.

More at [php-vfs github page](http://thornag.github.io/php-vfs);
