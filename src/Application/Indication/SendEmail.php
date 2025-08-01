<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Application\Indication;

use Tiagolopes\CleanArchitecture\Domain\Student\Entity\Student;

interface SendEmail
{
    public function mailTo(Student $nominatedStudent): void;
}
