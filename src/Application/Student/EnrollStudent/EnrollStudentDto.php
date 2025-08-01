<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Application\Student\EnrollStudent;

readonly class EnrollStudentDto
{
    public function __construct(
        public string $cpf,
        public string $name,
        public string $email
    ) {
    }
}
