<?php

namespace University;

class Statistic
{
    private $acceptCount;
    private $acceptAndDocumentOriginalCount;
    private $documentCopyCount;
    private $documentOriginalCount;
    private $indexByPoints;
    private $otherWayCount;
    private $documentOriginalAndOtherWayCount;
    private $datetime;

    public function __construct(Students $students)
    {
        $this->acceptCount                      = 0;
        $this->acceptAndDocumentOriginalCount   = 0;
        $this->documentCopyCount                = 0;
        $this->documentOriginalCount            = 0;
        $this->indexByPoints                    = 0;
        $this->otherWayCount                    = 0;
        $this->documentOriginalAndOtherWayCount = 0;
        $this->datetime                         = new \DateTime();
        $students->sort();
        $this->math($students->get());
    }

    public function incrAcceptCount()
    {
        $this->acceptCount++;
    }

    public function incrDocumentCopyCount()
    {
        $this->documentCopyCount++;
    }

    public function incrDocumentCOriginslCount()
    {
        $this->documentOriginalCount++;
    }

    public function incrIndexByPoints()
    {
        $this->indexByPoints++;
    }

    public function incrOtherWayCount()
    {
        $this->otherWayCount++;
    }

    public function incrDocumentOriginalAndOtherWayCount()
    {
        $this->documentOriginalAndOtherWayCount++;
    }

    public function incrAcceptAndDocumentOriginalCount()
    {
        $this->acceptAndDocumentOriginalCount++;
    }

    private function math(array $students)
    {
        /** @var Student $student */
        foreach ($students as $student) {

            if ($student->getDocumentType() === Student::DOCUMENT_ORIGINAL) {
                $this->incrDocumentCOriginslCount();
            }

            if ($student->getDocumentType() === Student::DOCUMENT_COPY) {
                $this->incrDocumentCopyCount();
            }

            if ($student->getAccept()) {
                $this->incrAcceptCount();
            }

            if ($student->isOtherWay()) {
                $this->incrOtherWayCount();
            }

            if ($student->isOtherWay() && $student->getDocumentType() === Student::DOCUMENT_ORIGINAL) {
                $this->incrDocumentOriginalAndOtherWayCount();
            }

            if ($student->getAccept() && $student->getDocumentType() === Student::DOCUMENT_ORIGINAL) {
                $this->incrAcceptAndDocumentOriginalCount();
            }

            if (false !== mb_strpos(mb_strtolower($student->getName()), 'чурилина')) {
                break;
            }

            $this->incrIndexByPoints();
        }
    }

    /**
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @return int
     */
    public function getAcceptCount()
    {
        return $this->acceptCount;
    }

    /**
     * @return int
     */
    public function getAcceptAndDocumentOriginalCount()
    {
        return $this->acceptAndDocumentOriginalCount;
    }

    /**
     * @return int
     */
    public function getDocumentCopyCount()
    {
        return $this->documentCopyCount;
    }

    /**
     * @return int
     */
    public function getDocumentOriginalCount()
    {
        return $this->documentOriginalCount;
    }

    /**
     * @return int
     */
    public function getIndexByPoints()
    {
        return $this->indexByPoints;
    }

    /**
     * @return int
     */
    public function getOtherWayCount()
    {
        return $this->otherWayCount;
    }

    /**
     * @return int
     */
    public function getDocumentOriginalAndOtherWayCount()
    {
        return $this->documentOriginalAndOtherWayCount;
    }
}