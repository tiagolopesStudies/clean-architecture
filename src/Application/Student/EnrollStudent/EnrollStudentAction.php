<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Application\Student\EnrollStudent;

use Tiagolopes\CleanArchitecture\Domain\Student\Entity\Student;
use Tiagolopes\CleanArchitecture\Domain\Student\Repository\StudentRepository;

readonly class EnrollStudentAction
{
    public function __construct(private StudentRepository $repository)
    {
    }

    public function execute(EnrollStudentDto $enrollStudentDto): void
    {
        $student = Student::createWithCpfNameAndEmail(
            cpf: $enrollStudentDto->cpf,
            name: $enrollStudentDto->name,
            email: $enrollStudentDto->email
        );

        $this->repository->create($student);
    }
}
