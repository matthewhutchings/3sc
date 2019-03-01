<?php
namespace Tsc\CatStorageSystem;

use \DateTimeInterface;

class FileClass implements FileInterface {
    /** @var string */
    private $name;
    /** @var int */
    private $size;
    /** @var DateTime */
    private $createdTime;
    /** @var DateTime */
    private $modifiedTime;
    /** @var string */
    private $parentDirectory;

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
    public function setParentDirectory($parent): DirectoryClass{
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