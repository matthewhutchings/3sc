<?php
namespace Tsc\CatStorageSystem\Resources;

class FileSystem implements FileSystemInterface {
    /**
     * @param FileInterface   $file
     * @param DirectoryInterface $parent
     *
     * @return File
     */
    public function createFile($file, $parent) {

        $fileMaker = fopen($file->getName(), "w") or die("Unable to open file!");
        $contents = file_get_contents('./src/Resources/cat.php');
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $contents));
        fwrite($fileMaker, $data);
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
        $contents = file_get_contents('./src/Resources/cat1.php');
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $contents));
        fwrite($fileMaker, $data);
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
        $file->setName(rename($file->getPath(), $file->getParentDirectory()->getPath() . '/' . $newName));

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
        return Folder::folderSize($directory->getName());
    }

    /**
     * @param DirectoryInterface $directory
     *
     * @return DirectoryInterface[]
     */
    public function getDirectories(DirectoryInterface $directory) {
        return Folder::getFileList("images/", 'dir');
    }

    /**
     * @param DirectoryInterface $directory
     *
     * @return FileInterface[]
     */
    public function getFiles(DirectoryInterface $directory) {
        return Folder::getFileList("images/", 'files');
    }
}