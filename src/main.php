<?php

declare(strict_types=1);

use Tiagolopes\CleanArchitecture\Domain\Student\Entity\Student;

require_once __DIR__ . '/../vendor/autoload.php';

$student = Student::createWithCpfNameAndEmail('12345654378', 'Tiago Lopes', 'teste@gmail.com');
$student->addPhone('11', '999999999');

echo $student->cpf . PHP_EOL;
echo $student->name . PHP_EOL;
echo $student->email . PHP_EOL;

foreach ($student->phones as $index => $phone) {
    echo 'Phone ' . ($index+1) . ' - ' . $phone . PHP_EOL;
}
