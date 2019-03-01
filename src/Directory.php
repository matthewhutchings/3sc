<?php
namespace Tsc\CatStorageSystem;

use \DateTimeInterface;

class DirectoryClass implements DirectoryInterface {
    /** @var string */
    private $name;
    /** @var dateTime */
    private $createdTime;
    /** @var string */
    private $path;

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
     * @return DateTimeInterface
     */
    public function getCreatedTime() {
        return $this->createdTime;
    }

    /**
     * @param DateTimeInterface $created
     *
     * @return $this
     */
    public function setCreatedTime($created): DateTimeInterface{
        $this->createdTime = $created;

        return $created;
    }

    /**
     * @return string
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * @param string $path
     *
     * @return $this
     */
    public function setPath($path) {
        $this->path = $path;

        return $this;

    }
}
