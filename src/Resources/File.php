<?php
namespace Tsc\CatStorageSystem\Resources;

use \DateTimeInterface as DateTimeInterface;

//use Tsc\CatStorageSystem\Interface\FileInterface;

class File implements FileInterface {
    /** @var string */
    private $name;
    /** @var int */
    private $size;
    /** @var DateTime */
    private $createdTime;
    /** @var DateTime */
    private $modifiedTime;

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getSize() {
        return $this->size;
    }

    /**
     * @param int $size
     *
     * @return $this
     */
    public function setSize($size) {
        $this->size = $size;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedTime() {
        return $this->createdTime;
    }

    /**
     * @param DateTimeInterface $created
     *
     * @return $created
     */
    public function setCreatedTime($created): DateTimeInterface{
        $this->createdTime = $created;

        return $created;
    }

    /**
     * @return DateTimeInterface
     */
    public function getModifiedTime() {
        return $this->modifiedTime;
    }

    /**
     * @param DateTimeInterface $modified
     *
     * @return $modified
     */
    public function setModifiedTime($modified): DateTimeInterface{
        $this->modifiedTime = $modified;

        return $modified;
    }

    /**
     * @return DirectoryClass
     */
    public function getParentDirectory() {
        return $this->parentDirectory;
    }

    /**
     * @param DirectoryClass $parent
     *
     * @return $parent
     */
    public function setParentDirectory($parent): Directory{
        $this->parentDirectory = $parent;

        return $parent;
    }

    /**
     * @return string
     */
    public function getPath() {
        return $this->parentDirectory->getPath() . "/" . $this->name;
    }
}