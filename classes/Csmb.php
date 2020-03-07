<?php

namespace Board;

use \Passable;
use \Student;

class CSMB implements Passable 
{
    public $id = 2;

    public function average(Student $student)
    {
        if(max($student->grades) >= 8){
            return true;
        }

        return false;
    }
}