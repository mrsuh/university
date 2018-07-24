<?php

namespace University;

class Students
{

    private $students;

    public function __construct()
    {
        $this->students = [];
    }

    public function add(Student $student)
    {
        $this->students[] = $student;
    }

    public function get()
    {
        return $this->students;
    }

    public function sort()
    {
        usort($this->students, function ($aStudent, $bStudent) {
            $a = $aStudent->getPoints();
            $b = $bStudent->getPoints();

            if ($a === $b) {
                return 0;
            }

            return ($a > $b) ? -1 : 1;
        });
    }
}