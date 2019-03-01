<?php

require "vendor/autoload.php";

use Tsc\CatStorageSystem\GifClass;

$gif = new GifClass();

$gif->newFile('test');
$gif->setSize();
var_dump($gif);
