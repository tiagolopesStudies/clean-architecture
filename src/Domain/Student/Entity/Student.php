<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Domain\Student\Entity;

use Tiagolopes\CleanArchitecture\Domain\Student\ValueObject\{Email, Cpf, Phone};

class Student
{
    /** @var array<Phone> $phones */
    public array $phones;

    private function __construct(
        public readonly ?int $id,
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
            id: null,
            cpf: Cpf::create($cpf),
            name: $name,
            email: Email::create($email)
        );
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            cpf: Cpf::create($data['cpf']),
            name: $data['name'],
            email: Email::create($data['email'])
        );
    }

    public function addPhone(string $ddd, string $phone): void
    {
        $this->phones[] = Phone::create($ddd, $phone);
    }
}
