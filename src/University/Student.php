<?php

namespace University;

class Student
{

    const DOCUMENT_ORIGINAL = 1;
    const DOCUMENT_COPY     = 2;

    private $index;
    private $name;
    private $points;
    private $documentType;
    private $accept;
    private $otherWay;

    public function __construct()
    {
        $this->accept       = false;
        $this->otherWay     = false;
        $this->name         = '';
        $this->points       = 0;
        $this->documentType = self::DOCUMENT_COPY;
        $this->index        = 0;
    }

    /**
     * @return mixed
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @param $index
     * @return $this
     */
    public function setIndex($index)
    {
        $this->index = $index;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param $points
     * @return $this
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDocumentType()
    {
        return $this->documentType;
    }

    /**
     * @param $documentType
     * @return $this
     */
    public function setDocumentType($documentType)
    {
        $this->documentType = $documentType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccept()
    {
        return $this->accept;
    }

    /**
     * @param $accept
     * @return $this
     */
    public function setAccept($accept)
    {
        $this->accept = $accept;

        return $this;
    }

    /**
     * @return bool
     */
    public function isOtherWay()
    {
        return $this->otherWay;
    }

    /**
     * @param $otherWay
     * @return $this
     */
    public function setOtherWay($otherWay)
    {
        $this->otherWay = $otherWay;

        return $this;
    }
}