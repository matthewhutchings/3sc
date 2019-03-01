<?php
namespace Tsc\CatStorageSystem;

class Directory {

    public function __construct() {
        $this->fileSystem = new FileSystemClass;
        $this->directory = new DirectoryClass;
    }

    public function createRootDirectory($newName) {
        $newDirectory = new DirectoryClass;
        $newDirectory->setName($newName)
            ->setPath('images');

        return $this->fileSystem->createRootDirectory($newDirectory);
    }

    /**
     * Delete Directory
     *
     * @return $directory
     */
    public function delete($dirName) {
        $directory = new DirectoryClass;
        $directory->setName($dirName);
        return $this->fileSystem->deleteDirectory($directory);

    }

    /**
     * Rename Directory
     *
     * @return $directory
     */
    public function rename($oldName, $newName) {
        $oldDirectory = new DirectoryClass;
        $oldDirectory->setName($oldName);

        $newDirectory = new DirectoryClass;
        $newDirectory->setName($newName);

        $directory = $this->fileSystem->renameDirectory($oldDirectory, $newDirectory);
        return $directory;
    }
    /**
     * Count Directories
     *
     * @return $directory
     */
    public function count($directoryName) {
        $this->directory->setName($directoryName);
        return $this->fileSystem->getDirectoryCount($this->directory);
    }

    /**
     * Return Directory Size
     *
     * @return string
     */
    public function size($directoryName) {
        $this->directory->setName($directoryName);
        return $this->fileSystem->getDirectorySize($this->directory);
    }

    /**
     * Return File Count
     *
     * @return string
     */
    public function fileCount($directoryName) {
        $this->directory->setName($directoryName);
        return $this->fileSystem->getFileCount($this->directory);
    }
    /**
     * List of files within directory
     *
     * @return array
     */
    public function listFiles($directoryName) {
        $this->directory->setName($directoryName);
        return $this->fileSystem->getFiles($this->directory);
    }

    /**
     * List of Directories
     *
     * @return array
     */
    public function listDirectories($directoryName) {
        $this->directory->setName($directoryName);
        return $this->fileSystem->getDirectories($this->directory);
    }
}