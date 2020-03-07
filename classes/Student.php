<?php

class Student {
    public $name;
    public $board;
    public $grades= [];
    public $averageResult;
    public $finalResult;

    public function __construct($name, Passable $board)
    {
        $this->name = $name;
        $this->board = $board;
    }

    public function addGrade($grade)
    {
        if(count($this->grades) < 4){
            $this->grades[] = $grade;
        }
    }
}