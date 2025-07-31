<?php

declare(strict_types=1);

use Tiagolopes\CleanArchitecture\Domain\Student\Entity\Student;
use Tiagolopes\CleanArchitecture\Infra\Database\PdoConnection;
use Tiagolopes\CleanArchitecture\Infra\Repository\PdoStudentRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$student = Student::createWithCpfNameAndEmail('12345654378', 'Tiago Lopes', 'teste@gmail.com');
$student->addPhone('11', '999999999');

$studentRepository = new PdoStudentRepository(PdoConnection::getInstance());
$students = $studentRepository->findAll();

foreach ($students as $student) {
    echo $student->cpf . PHP_EOL;
    echo $student->name . PHP_EOL;
    echo $student->email . PHP_EOL;
    echo '===================' . PHP_EOL;
}
