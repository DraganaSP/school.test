<?php

require_once "vendor/autoload.php";

use Board\CSM as CSM;
use Board\CSMB as CSMB;

class Student
{
    public $name;
    public $board;
    public $grades = [];
    public $averageResult;
    public $finalResult;

    public function __construct($name, Passable $board)
    {
        $this->name = $name;
        $this->board = $board;
    }

    public function addGrade($grade)
    {
        if (count($this->grades) < 4) {
            $this->grades[] = $grade;
        }
    }

    public function save()
    {
        $query = 'INSERT INTO students (name, board_id) VALUES (:name, :board_id)';

        $args = ['name' => $this->name, 'board_id' => $this->board->id];

        $conn = new Connection;

        $conn->run($query, $args);

        $argsGrades = [];

        foreach ($this->grades as $grade) {
            $argsGrades[] = ['student_id' => $conn->lastInsertId(), 'grade' => $grade];
        }

        $conn->pdoMultiInsert('studentGrades', $argsGrades);
    }

    public static function getStudent($id)
    {
        $conn = new Connection;
        $args = ['id' => $id];

        $csm = new CSM;
        $csmb = new CSMB;

        $student = $conn->run('SELECT students.*, studentGrades.grade FROM students JOIN studentGrades on 
            students.id = studentGrades.student_id WHERE students.id = :id', $args)->fetchAll(PDO::FETCH_ASSOC);

        if (!count($student)) {
            header('Location: ./notFound.php');
            die();
        }

        $gradeArr = array_map(function ($row) {
            return $row['grade'];
        }, $student);

        $board = $student[0]['board_id'] == 1 ? $csm : $csmb;
        $self = new self($student[0]['name'], $board);
        $self->grades = $gradeArr;

        return $board->average($self);
    }
}
