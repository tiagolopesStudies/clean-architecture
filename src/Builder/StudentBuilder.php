<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Builder;

use Tiagolopes\CleanArchitecture\Entity\Student;
use Tiagolopes\CleanArchitecture\Entity\ValueObject\{Cpf, Email, Phone};

class StudentBuilder
{
    private(set) Student $student;
    public function __construct()
    {
        $this->student = new Student();
    }

    public function withCpfAndName(string $cpf, string $name): self
    {
        $this->student->cpf  = Cpf::create($cpf);
        $this->student->name = $name;
        return $this;
    }

    public function withEmail(string $email): self
    {
        $this->student->email = Email::create($email);
        return $this;
    }

    public function withPhone(string $ddd, string $number): self
    {
        $this->student->phone = Phone::create($ddd, $number);
        return $this;
    }

    public function build(): Student
    {
        return $this->student;
    }
}
