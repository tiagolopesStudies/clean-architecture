<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Tiagolopes\CleanArchitecture\Entity\Student;
use Tiagolopes\CleanArchitecture\Entity\ValueObject\{Phone, Cpf, Email};

$student = new Student(
    cpf: Cpf::create('12345678910'),
    name: 'Tiago Lopes',
    email: Email::create('teste@gmail.com'),
    phone: Phone::create('19', '965471033')
);

echo $student->cpf . PHP_EOL;
echo $student->name . PHP_EOL;
echo $student->email . PHP_EOL;
echo $student->phone . PHP_EOL;
