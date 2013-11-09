<?php


class Checker {

    protected $root;

    public function __construct($root)
    {
        $this->root = $root;
    }

    public function result($result, $header)
    {
        echo $header;
        if ($result) {
           echo '√';
        } else {
            echo 'x';
        }
        echo PHP_EOL;
    }

    public function checkCache()
    {
        $a = is_dir($this->root.'/cache');
        $b = is_writable($this->root.'/cache');
        return is_dir($this->root.'/cache') && is_writable($this->root.'/cache');
    }

    public function checkLog()
    {
        return is_dir($this->root.'/logs') && is_writable($this->root.'/logs');
    }

    public function checkLib()
    {
        return  !is_writable($this->root.'/lib') && is_readable($this->root.'/lib');
    }

    public function checkInstaller()
    {
        return !file_exists($this->root.'/lib');
    }

} 