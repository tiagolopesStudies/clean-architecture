<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Domain\Student\Repository;

use Tiagolopes\CleanArchitecture\Domain\Student\Entity\Student;

interface StudentRepository
{
    public function create(Student $student): void;

    public function update(Student $student): void;

    public function getByCpf(string $cpf): Student;

    /** @return array<Student> */
    public function findAll(): array;
}
