<?php
namespace Tsc\CatStorageSystem\Resources;

class Folder {
    public static function makeFile($fileName, $catname) {
        $fileMaker = fopen($fileName, "w") or die("Unable to open file!");

        $contents = file_get_contents('./src/Resources/cat' . $catname . '.php');

        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $contents));

        fwrite($fileMaker, $data);

        fclose($fileMaker);
    }
    public static function getFileList($dir, $type) {
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

            $retval[] = [
                'name' => "{$dir}{$fileinfo}",
                'type' => ($fileinfo->getType() == "dir") ? "dir" : mime_content_type($fileinfo->getRealPath()),
                'size' => $fileinfo->getSize(),
                'lastmod' => $fileinfo->getMTime(),
            ];

        }

        if ($type == 'dir' && $fileinfo->getType() == "dir") {
            return self::filter_by_value($retval, 'type', 'dir');
        }
        if ($type == 'files') {
            return self::filter_by_value($retval, 'type', 'image/gif');
        }
    }

    /*
     * filtering an array
     */
    public static function filter_by_value($array, $index, $value) {
        $newarray = [];
        if (is_array($array) && count($array) > 0) {
            foreach (array_keys($array) as $key) {
                $temp[$key] = $array[$key][$index];

                if ($temp[$key] == $value) {
                    $newarray[$key] = $array[$key];
                }
            }
        }
        return $newarray;
    }
    public static function folderSize($dir) {
        $size = 0;
        foreach (glob(rtrim($dir, '/') . '/*', GLOB_NOSORT) as $each) {
            $size += is_file($each) ? filesize($each) : self::folderSize($each);
        }
        return $size;
    }
}