<?php

namespace Board;

use \Passable;
use \Student;

class CSM implements Passable 
{
    public $id = 1;
    public $name = 'CSM';

    public function average(Student $student)
    {
        $student->board = $this;
        $sum = array_sum($student->grades);
        $student->averageResult = $sum / count($student->grades);

        $student->finalResult = $student->averageResult >= 7 ? 'pass' : 'fail';

        return json_encode($student);
    }
}
