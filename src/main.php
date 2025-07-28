<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Tiagolopes\CleanArchitecture\Builder\StudentBuilder;

$student = new StudentBuilder()
    ->withCpfAndName('12301234765', 'Tiago')
    ->withEmail('teste@gmail.com')
    ->withPhone('11', '999999999')
    ->build();

echo $student->cpf . PHP_EOL;
echo $student->name . PHP_EOL;
echo $student->email . PHP_EOL;
echo $student->phone . PHP_EOL;
