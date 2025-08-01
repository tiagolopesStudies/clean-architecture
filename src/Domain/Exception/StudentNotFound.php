<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Domain\Exception;

use DomainException;

class StudentNotFound extends DomainException
{
    public static function fromCpf(string $cpf): self
    {
        return new self("Student with CPF '$cpf' not found");
    }

    public static function fromId(int $id): self
    {
        return new self("Student with ID '$id' not found");
    }
}
