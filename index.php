<?php

require_once "vendor/autoload.php";

if (isset($_GET)) {
    $student = Student::getStudent($_GET['student']);

    echo $student;
}
