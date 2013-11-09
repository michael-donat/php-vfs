#!/usr/bin/env php
<?php

class PackageXML
{
    public function run()
    {

        $template = file_get_contents(__DIR__.'/package.tpl');

        $opts = getopt("", array('version::', 'source::'));

        if (!isset($opts['version']) || !isset($opts['source'])) {
            $this->usage();
        }

        $template = str_replace(
            array(
                '{{date}}',
                '{{version}}'
            ),
            array(
                date('Y-m-d', time()),
                $opts['version']
            ),
            $template
        );

        $source = $opts['source'];
        if (substr($source, 0, 1) != '/') {
            $source = getcwd().'/'.$source;
        }

        $document = new DOMDocument('1.0');
        $document->preserveWhiteSpace = false;
        $document->loadXML($template);
        $document->formatOutput = true;

        $root = $document->documentElement;

        $before = $root->getElementsByTagName('dependencies')->item(0);

        $contents = new DOMElement('contents');
        $root->insertBefore($contents, $before);
        $contentsChild = new DOMElement('dir');
        $contents->appendChild($contentsChild);
        $contentsChild->setAttribute('name', '/');
        $contentsChild->setAttribute('baseinstalldir', '/');
        $contentsChild->appendChild($srcWrap = new DOMElement('dir'));
        $srcWrap->setAttribute('name', basename($source));
        $this->getDirectoryListing($source, $srcWrap);

        $root->appendChild($wrap = new DOMElement('phprelease'));
        $wrap->appendChild($wrap = new DOMElement('filelist'));

        $this->getInstallListing($source, getcwd(), $wrap);

        $contentsChild->appendChild($doc = new DOMElement('file'));
        $doc->setAttribute('name', 'LICENCE');
        $doc->setAttribute('role', 'doc');

        $contentsChild->appendChild($doc = new DOMElement('file'));
        $doc->setAttribute('name', 'README.md');
        $doc->setAttribute('role', 'doc');

        $contentsChild->appendChild($doc = new DOMElement('file'));
        $doc->setAttribute('name', 'CONTRIBUTORS.md');
        $doc->setAttribute('role', 'doc');

        echo $document->saveXML();

    }

    protected function getInstallListing($directory, $cut, $parentNode)
    {
        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS));
        foreach($objects as $name => $object){
            $file = ltrim(str_replace($cut, '', $name), '/');
            $as = ltrim(str_replace($directory, '', $name), '/');
            $parentNode->appendChild($node = new DOMElement('install'));
            $node->setAttribute('name', $file);
            $node->setAttribute('as', $as);
        }
    }

    protected function getDirectoryListing($directory, $parentNode)
    {
        $return = $parentNode;

        $iterator = new DirectoryIterator($directory);
        foreach ($iterator as $fileInfo) {
            if ($fileInfo->isDot()) {
                continue;
            }
            if ($fileInfo->isDir()) {
                $node = new DOMElement('dir');
                $return->appendChild($node);
                $node->setAttribute('name', $fileInfo->getBasename());
                $this->getDirectoryListing($fileInfo->getPathname(), $node);
            } else {
                $node = new DOMElement('file');
                $return->appendChild($node);
                $node->setAttribute('name', $fileInfo->getBasename());
                $node->setAttribute('role', 'php');
            }
        }
    }

    public function usage()
    {
        echo <<<STDOUT
    Usage: package --version= --source=

STDOUT;
        exit(1);

    }
}
$a = $argc;
$b = $argv;
$c = realpath(__FILE__);

if (realpath($argv[0]) == realpath(__FILE__)) {
    $pxml = new PackageXML();
    $pxml->run();
}