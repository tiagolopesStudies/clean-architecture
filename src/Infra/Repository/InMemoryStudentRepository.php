<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Infra\Repository;

use Tiagolopes\CleanArchitecture\Domain\Exception\StudentNotFound;
use Tiagolopes\CleanArchitecture\Domain\Student\Entity\Student;
use Tiagolopes\CleanArchitecture\Domain\Student\Repository\StudentRepository;

class InMemoryStudentRepository implements StudentRepository
{
    /** @var array<Student> $students */
    private(set) array $students;

    public function __construct()
    {
        $this->students = [];
    }

    public function store(Student $student): void
    {
        $this->students[] = $student;
    }

    public function getByCpf(string $cpf): Student
    {
        $studentsArray = array_filter($this->students, fn(Student $student) => $student->cpf === $cpf);

        if (empty($studentsArray)) {
            throw StudentNotFound::fromCpf($cpf);
        }

        return array_pop($studentsArray);
    }

    public function findAll(): array
    {
       return $this->students;
    }
}
