<?php

namespace Board;

use \Passable;
use \Student;

class CSMB implements Passable 
{
    public $id = 2;
    public $name = 'CSMB';

    public function average(Student $student)
    {
        $student->board = $this;
        $student->averageResult = max($student->grades);
        $student->finalResult = max($student->grades) >= 8 ? 'pass' : 'fail';

        return xmlrpc_encode($student);
    }
}