<?php
namespace Tsc\CatStorageSystem;

class FileSystemClass implements FileSystemInterface {
    /**
     * @param FileInterface   $file
     * @param DirectoryInterface $parent
     *
     * @return FileInterface
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
     * @return FileInterface
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
        rename($file->getParentDirectory() . '/' . $file->getName(), $file->getParentDirectory() . '/' . $newName);
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
        $path = $directory->getPath() . '/' . $directory->getName() . '/';
        mkdir($path);
        $directory->setPath($path);
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
        return rmdir('images/' . $directory->getName());
    }

    /**
     * @param DirectoryInterface $directory
     * @param string $newName
     *
     * @return DirectoryInterface
     */
    public function renameDirectory(DirectoryInterface $directory, $newName) {
        $oldPath = 'images/' . $directory->getName();
        $NewPath = 'images/' . $newName->getName();

        rename($oldPath, $NewPath);

        $directory->setPath($NewPath);

        return $directory;
    }

    /**
     * @param DirectoryInterface $directory
     *
     * @return int
     */
    public function getDirectoryCount(DirectoryInterface $directory) {
        //return iterator_count(new \DirectoryIterator($directory->getName()));
        //  return count(glob($directory->getName() . "/[!\.]*"));
        return count(glob($directory->getName() . '/*', GLOB_ONLYDIR));
    }

    /**
     * @param DirectoryInterface $directory
     *
     * @return int
     */
    public function getFileCount(DirectoryInterface $directory) {
        return count(glob($directory->getName() . '*.{*}', GLOB_BRACE));
    }

    /**
     * @param DirectoryInterface $directory
     *
     * @return int
     */
    public function getDirectorySize(DirectoryInterface $directory) {
        return $this->folderSize($directory->getName());
    }

    public function folderSize($dir) {
        $size = 0;
        foreach (glob(rtrim($dir, '/') . '/*', GLOB_NOSORT) as $each) {
            $size += is_file($each) ? filesize($each) : $this->folderSize($each);
        }
        return $size;
    }
    /**
     * @param DirectoryInterface $directory
     *
     * @return DirectoryInterface[]
     */
    public function getDirectories(DirectoryInterface $directory) {
        return $this->getFileList("images/", 'dir');
    }

    /**
     * @param DirectoryInterface $directory
     *
     * @return FileInterface[]
     */
    public function getFiles(DirectoryInterface $directory) {
        return $this->getFileList("images/", 'files');
    }

    function getFileList($dir, $type) {
        // array to hold return value
        $retval = [];

        // add trailing slash if missing
        if (substr($dir, -1) != "/") {
            $dir .= "/";
        }

        // open directory for reading
        $d = new \DirectoryIterator($dir) or die("getFileList: Failed opening directory $dir for reading");
        foreach ($d as $fileinfo) {
            // skip hidden files
            if ($fileinfo->isDot()) {
                continue;
            }

            if ($type == 'dir' && $fileinfo->getType() == "dir") {

                $retval[] = [
                    'name' => "{$dir}{$fileinfo}",
                    'type' => ($fileinfo->getType() == "dir") ? "dir" : mime_content_type($fileinfo->getRealPath()),
                    'size' => $fileinfo->getSize(),
                    'lastmod' => $fileinfo->getMTime(),
                ];

            } else if ($type == 'files' && $fileinfo->getType() != "dir") {

                $retval[] = [
                    'name' => "{$dir}{$fileinfo}",
                    'type' => ($fileinfo->getType() == "dir") ? "dir" : mime_content_type($fileinfo->getRealPath()),
                    'size' => $fileinfo->getSize(),
                    'lastmod' => $fileinfo->getMTime(),
                ];

            }

        }

        return $retval;
    }
}