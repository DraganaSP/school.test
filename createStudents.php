<?php

require 'vendor/autoload.php';

use Board\CSM as CSM;
use Board\CSMB as CSMB;
use Student;

$csm = new CSM;
$csmb = new CSMB;

$student = new Student('Dragana', $csm);

$student->addGrade(7);
$student->addGrade(8);
$student->addGrade(6);
$student->addGrade(10);


print_r($csm->average($student));

$student1 = new Student('Nikola', $csmb);

$student1->addGrade(4);
$student1->addGrade(8);
$student1->addGrade(6);
$student1->addGrade(2);


print_r($csmb->average($student1));