<?php

require "vendor/autoload.php";

use Tsc\CatStorageSystem\DirectoryManager;
use Tsc\CatStorageSystem\GifClass;

$gif = new GifClass();
$directory = new DirectoryManager();

// Open an existing gif
//$cat = $gif->openImage('images/test.gif');
// Create a new file
$cat = $gif->newImage('images/examplre1');

// Rename File
$gif->rename('rtrt');
//$cat->getSize();
//$cat->getName();
echo $cat->getPath();
//$cat->getCreatedTime()->format('Y-m-d H:i:s');
//$cat->getModifiedTime()->format('Y-m-d H:i:s');

// Create Directory within Images
//$directory->createRootDirectory('tythy');
//$directory->delete('tythy');
//$directory->rename('test1', 'hello');
//$directory->directoryCount('images/');
//$directory->fileCount('images/');
//$directory->size('images/');

//print_r($directory->listFiles('images/'));
//print_r($gif->listDirectories('images/'));
