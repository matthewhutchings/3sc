<?php
namespace Tsc\CatStorageSystem;

use Tsc\CatStorageSystem\DirectoryClass;
use Tsc\CatStorageSystem\FileClass;
use Tsc\CatStorageSystem\FileSystemClass;

class GifClass {

    public function __construct($location) {
        $this->file = new FileClass;
        $this->fileSystem = new FileSystemClass;
        $this->directory = new DirectoryClass;

        $file = new \SplFileObject($location);

        $this->directory
            ->setName($file->getPath())
            ->setPath($file->getRealPath())
            ->setCreatedTime(new \DateTime('@' . filemtime($file->getPath())));

        $this->file
            ->setSize($file->getSize())
            ->setName($file->getBaseName())
            ->setParentDirectory($this->directory);

        $this->file->setCreatedTime(new \DateTime('@' . $file->getCTime()));
        $this->file->setModifiedTime(new \DateTime('@' . $file->getMTime()));

    }
    public function setName($test) {

        $this->file->setName($test);
    }

}