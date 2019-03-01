<?php
namespace Tsc\CatStorageSystem;

class FileSystemClass implements FileSystemInterface {
    /**
     * @param FileInterface   $file
     * @param DirectoryInterface $parent
     *
     * @return File
     */
    public function createFile($file, $parent) {

        $fileMaker = fopen($file->getName(), "w") or die("Unable to open file!");
        fwrite($fileMaker, date("d/m/Y"));
        fclose($fileMaker);
        return $file;
    }

    /**
     * @param FileInterface $file
     *
     * @return File
     */
    public function updateFile(FileInterface $file) {
        $fileMaker = fopen($file->getName(), "w") or die("Unable to open file!");
        fwrite($fileMaker, 'Yes');
        fclose($fileMaker);
        return $file;
    }

    /**
     * @param FileInterface $file
     * @param string $newName
     *
     * @return FileInterface
     */
    public function renameFile(FileInterface $file, $newName) {
        rename($file->getPath(), $file->getParentDirectory()->getPath() . '/' . $newName);

        $file->setName($newName);

        return $file;
    }

    /**
     * @param FileInterface $file
     *
     * @return bool
     */
    public function deleteFile(FileInterface $file) {
        return unlink($file->getPath());
    }

    /**
     * @param DirectoryInterface $directory
     *
     * @return DirectoryInterface
     */
    public function createRootDirectory(DirectoryInterface $directory) {

        $directory->setPath(mkdir($directory->getName()));

        return $directory;
    }

    /**
     * @param DirectoryInterface $directory
     * @param DirectoryInterface $parent
     *
     * @return DirectoryInterface
     */
    public function createDirectory(
        DirectoryInterface $directory, DirectoryInterface $parent
    ) {
        //createRootDirectory can create sub directories.. oh well.
    }

    /**
     * @param DirectoryInterface $directory
     *
     * @return bool
     */
    public function deleteDirectory(DirectoryInterface $directory) {
        return rmdir($directory->getName());
    }

    /**
     * @param Directory $directory
     * @param string $newName
     *
     * @return DirectoryInterface
     */
    public function renameDirectory(DirectoryInterface $directory, $newName) {
        rename($directory->getName(), $newName);

        $directory->setPath($NewPath);
        $directory->setName($newName);

        return $directory;
    }

    /**
     * @param DirectoryInterface $directory
     *
     * @return int
     */
    public function getDirectoryCount(DirectoryInterface $directory) {
        return count(glob($directory->getName() . '/*', GLOB_ONLYDIR));
    }

    /**
     * @param DirectoryInterface $directory
     *
     * @return int
     */
    public function getFileCount(DirectoryInterface $directory) {
        return count(glob($directory->getName() . '/*.{*}', GLOB_BRACE));
    }

    /**
     * @param DirectoryInterface $directory
     *
     * @return int
     */
    public function getDirectorySize(DirectoryInterface $directory) {
        return FolderClass::folderSize($directory->getName());
    }

    /**
     * @param DirectoryInterface $directory
     *
     * @return DirectoryInterface[]
     */
    public function getDirectories(DirectoryInterface $directory) {
        return FolderClass::getFileList("images/", 'dir');
    }

    /**
     * @param DirectoryInterface $directory
     *
     * @return FileInterface[]
     */
    public function getFiles(DirectoryInterface $directory) {
        return FolderClass::getFileList("images/", 'files');
    }
}