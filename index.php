<?php

require "vendor/autoload.php";

use Tsc\CatStorageSystem\GifClass;

$gif = new GifClass("images/cat_1.gif");

$gif->setName("sdfdsfsdf");
var_dump($gif);
