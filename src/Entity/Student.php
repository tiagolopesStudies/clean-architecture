<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Entity;

use Tiagolopes\CleanArchitecture\Entity\ValueObject\Cpf;
use Tiagolopes\CleanArchitecture\Entity\ValueObject\Email;
use Tiagolopes\CleanArchitecture\Entity\ValueObject\Phone;

class Student
{
    /** @var array<Phone> $phones */
    public array $phones;

    private function __construct(
        public readonly Cpf $cpf,
        public readonly string $name,
        public readonly Email $email,
    ) {
        $this->phones = [];
    }

    public static function createWithCpfNameAndEmail(
        string $cpf,
        string $name,
        string $email
    ): self {
        return new self(
            cpf: Cpf::create($cpf),
            name: $name,
            email: Email::create($email)
        );
    }

    public function addPhone(string $ddd, string $phone): void
    {
        $this->phones[] = Phone::create($ddd, $phone);
    }
}
