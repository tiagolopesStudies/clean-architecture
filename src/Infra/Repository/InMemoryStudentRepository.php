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

    public function create(Student $student): void
    {
        $this->students[] = $student;
    }

    public function update(Student $student): void
    {
        $index = array_find_key($this->students, fn(Student $s) => $s->id === $student->id);

        if (! $index) {
            throw StudentNotFound::fromId((int) $student->id);
        }

        $this->students[$index] = $student;
    }

    public function getByCpf(string $cpf): Student
    {
        $studentsArray = array_filter($this->students, fn(Student $student) => (string) $student->cpf === $cpf);

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
