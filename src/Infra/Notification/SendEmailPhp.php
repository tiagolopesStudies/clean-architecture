<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Infra\Notification;

use Tiagolopes\CleanArchitecture\Application\Indication\SendEmail;
use Tiagolopes\CleanArchitecture\Domain\Student\Entity\Student;

class SendEmailPhp implements SendEmail
{
    public function mailTo(Student $nominatedStudent): void
    {
        mail(
            to: (string) $nominatedStudent->email,
            subject: 'Student nomination',
            message: $this->getMessage($nominatedStudent)
        );
    }

    private function getMessage(Student $student): string
    {
        return <<<MSG
            Hello, $student->name!
            You have been nominated to be a student of the Clean Architecture course.
            Thank you!
        MSG;
    }
}
