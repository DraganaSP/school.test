<?php

namespace Board;

use \Passable;
use \Student;

class CSM implements Passable 
{
    public function average(Student $student)
    {
        $sum = array_sum($student->grades);

        if($sum / count($student->grades) >= 7){
            return true;
        }

        return false;
    }
}
