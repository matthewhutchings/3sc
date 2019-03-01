<?php
namespace Tsc\CatStorageSystem;

class DirectoryManager extends DirectoryClass {

    public function __construct() {
        $this->fileSystem = new FileSystemClass;
        $this->directory = new DirectoryClass;
    }
    /**
     * Define Directory
     *
     * @return Directory
     */
    public function directory($directoryName) {
        $this->directory
            ->setName(basename($directoryName))
            ->setPath(dirname($directoryName));
        $this->directory->setCreatedTime(new \DateTime('@' . filemtime($directoryName)));

        return $this->directory;
    }
    /**
     * Create a new directory
     *
     * @return Directory
     */
    public function createRootDirectory($newName) {
        $newDirectory = new DirectoryClass;
        $newDirectory->setName($newName)
            ->setPath('images');

        return $this->fileSystem->createRootDirectory($newDirectory);
    }

    /**
     * Delete Directory
     *
     * @return bool
     */
    public function delete($directory) {
        $this->directory->setName($directory);

        return $this->fileSystem->deleteDirectory($this->directory);
    }

    /**
     * Rename Directory
     *
     * @return $directory
     */
    public function rename($oldName, $newName) {
        $this->directory->setName($oldName);

        return $this->fileSystem->renameDirectory($this->directory, $newName);
    }
    /**
     * Count Directories
     *
     * @return int
     */
    public function directoryCount($directoryName) {
        $this->directory->setName($directoryName);

        return $this->fileSystem->getDirectoryCount($this->directory);
    }

    /**
     * Return Directory Size
     *
     * @return string
     */
    public function size($directoryName) {
        $directory = $this->directory($directoryName);

        return $this->fileSystem->getDirectorySize($directory);
    }

    /**
     * Return File Count
     *
     * @return string
     */
    public function fileCount($directoryName) {
        $directory = $this->directory($directoryName);

        return $this->fileSystem->getFileCount($directory);
    }
    /**
     * List of files within directory
     *
     * @return array
     */
    public function listFiles($directoryName) {
        $directory = $this->directory($directoryName);

        return $this->fileSystem->getFiles($directory);
    }

    /**
     * List of Directories
     *
     * @return array
     */
    public function listDirectories($directoryName) {
        $directory = $this->directory($directoryName);

        return $this->fileSystem->getDirectories($directory);
    }
}