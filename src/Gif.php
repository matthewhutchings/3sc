<?php

namespace Tsc\CatStorageSystem;

use Tsc\CatStorageSystem\DirectoryManager;
use Tsc\CatStorageSystem\Resources\Directory;
use Tsc\CatStorageSystem\Resources\File;
use Tsc\CatStorageSystem\Resources\FileSystem;

class Gif {

    protected $image;

    public function __construct() {
        $this->file = new File;
        $this->fileSystem = new FileSystem;
        $this->directory = new Directory;
        $this->directoryManager = new DirectoryManager;
    }
    /**
     * @param string   $location
     *
     * @return File Object
     */
    public function openImage($location) {
        $this->image = $this->setFile($location);

        return $this->image;
    }

    /**
     * @param string   $fileName
     *
     * @return File
     */
    public function newImage($fileName) {
        $image = $this->fileSystem->createFile(
            $this->file->setName($fileName),
            $this->directory
        );

        return self::openImage($image->getName());
    }

    private function setFile($filetoUse) {

        $file = new \SplFileObject($filetoUse);

        $this->directoryManager->directory($file->getPath());

        $this->file
            ->setSize($file->getSize())
            ->setName($file->getBaseName())
            ->setParentDirectory(
                $this->directoryManager->directory
            );

        $this->file->setCreatedTime(new \DateTime('@' . $file->getCTime()));
        $this->file->setModifiedTime(new \DateTime('@' . $file->getMTime()));

        return $this->file;
    }

    public function delete() {

        print_r($this->image);
        return $this->fileSystem->deleteFile($this->image);
    }
    public function rename($newName) {
        return $this->fileSystem->renameFile($this->image, $newName);
    }
}