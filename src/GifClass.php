<?php
namespace Tsc\CatStorageSystem;

use Tsc\CatStorageSystem\DirectoryClass;
use Tsc\CatStorageSystem\FileClass;

class GifClass {

    protected $image;

    public function __construct() {
        $this->file = new FileClass;
        $this->fileSystem = new FileSystemClass;
        $this->directory = new DirectoryClass;
    }
    /**
     * @param string   $location
     *
     * @return File Object
     */
    public function openImage($location) {
        $image = $this->setFile($location);
        $this->image = $image;
        return $this->image;
    }

    /**
     * @param string   $fileName
     *
     * @return FileInterface
     */
    public function newImage($fileName) {
        $image = $this->fileSystem
            ->createFile(
                $this->file->setName($fileName),
                $this->directory
            );

        $this->image = $this->setFile(
            $image->getName()
        );

        return $this->image;
    }

    private function setFile($filetoUse) {
        $file = new \SplFileObject($filetoUse);

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

        return $this->file;

    }

    public function delete() {
        $image = $this->fileSystem->deleteFile($this->image);
    }
    public function rename($newName) {
        $image = $this->fileSystem->renameFile($this->image, $newName);
    }

}