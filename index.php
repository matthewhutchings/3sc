<?php

require "vendor/autoload.php";

use Tsc\CatStorageSystem\DirectoryManager;
use Tsc\CatStorageSystem\GifClass;

$gif = new GifClass();
$directory = new DirectoryManager();

// Open an existing gif
//$cat = $gif->openImage('images/test.gif');
// Create a new file
$cat = $gif->newImage('images/cat_1.gif');

// Rename File
//$gif->rename('rtrt');

print_r($cat);

echo $cat->getSize();
echo $cat->getName();
echo $cat->getPath();
echo $cat->getCreatedTime()->format('Y-m-d H:i:s');
echo $cat->getModifiedTime()->format('Y-m-d H:i:s');

// Create Directory within Images
//$directory->createRootDirectory('tythy2');

//$directory->delete('tythy');

//print_r($directory->rename('hello12', 'hello1'));

echo $directory->size('images/');

echo $directory->directoryCount('images/hello');
echo "Folder Size: " . $directory->fileCount('images/');

print_r($directory->listFiles('images/'));
print_r($directory->listDirectories('images/'));
