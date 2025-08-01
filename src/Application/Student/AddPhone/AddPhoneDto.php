<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Application\Student\AddPhone;

readonly class AddPhoneDto
{
    public function __construct(
        public string $studentCpf,
        public string $ddd,
        public string $phone
    ) {
    }
}
