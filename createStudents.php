<?php

require 'vendor/autoload.php';

use Board\CSM as CSM;
use Board\CSMB as CSMB;
use Student;

$csm = new CSM;
$csmb = new CSMB;

$student = new Student('student1', $csm);

$student->addGrade(7);
$student->addGrade(8);
$student->addGrade(6);
$student->addGrade(10);


// print_r($csm->average($student));

$student->save();


$student1 = new Student('student2', $csmb);

$student1->addGrade(8);
$student1->addGrade(8);
$student1->addGrade(6);
$student1->addGrade(9);


// print_r($csmb->average($student1));

$student1->save();

$student2 = new Student('student3', $csm);

$student2->addGrade(6);
$student2->addGrade(6);
$student2->addGrade(8);


// print_r($csmb->average($student2));

$student2->save();