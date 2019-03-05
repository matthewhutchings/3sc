<?php

namespace Tsc\CatStorageSystem;

use PHPUnit\Framework\TestCase;
use Tsc\CatStorageSystem\DirectoryManager;
use Tsc\CatStorageSystem\Resources\Directory;

class FileTest extends TestCase {

    protected $directory;

    protected $directory_path;

    protected function setUp(): void{
        $this->directory = new DirectoryManager();
        $this->directory_path = 'images/';
    }

    public function testDirectoryExistsBySize() {
        $this->assertIsInt($this->directory->size($this->directory_path));
    }

    public function testCreateDirectory() {
        $this->directory->createRootDirectory('test');
        $this->assertFileExists('test');
    }

    public function testRenameDirectory() {
        $this->directory->rename('test', 'newname');

        $this->assertFileExists('newname');
    }

    public function testCreateDelete() {
        $test = $this->directory->delete('newname');
        $this->assertTrue($test);
    }
}
