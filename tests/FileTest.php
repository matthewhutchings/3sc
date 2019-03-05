<?php

namespace Tsc\CatStorageSystem;

use PHPUnit\Framework\TestCase;
use Tsc\CatStorageSystem\Gif;
use Tsc\CatStorageSystem\Resources\Directory;
use Tsc\CatStorageSystem\Resources\File;
use \DateTimeInterface as DateTimeInterface;

class DirectoryTest extends TestCase {

    protected $cat;

    protected function setUp(): void{
        $gif = new Gif();
        $this->cat = $gif->newImage('images/cat_1.gif');
    }

    public function testIntanceOfCatIsGif() {
        $this->assertInstanceOf(File::class, $this->cat);
    }

    public function testNameIsCorrect() {
        $this->assertEquals($this->cat->getName(), 'cat_1.gif');
    }

    public function testPathIsCorrect() {
        $this->assertEquals($this->cat->getPath(), 'images/cat_1.gif');
    }

    public function testSizeIsSet() {
        $this->assertIsInt($this->cat->getSize());
    }

    public function testCreatedTimeSet() {
        $this->assertInstanceOf(DateTimeInterface::class, $this->cat->getCreatedTime());
    }

    public function testUpdatedTimeSet() {
        $this->assertInstanceOf(DateTimeInterface::class, $this->cat->getModifiedTime());
    }

    public function testParentDirectory() {
        $this->assertInstanceOf(Directory::class, $this->cat->getParentDirectory());
    }
}
