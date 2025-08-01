<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Infra\Notification;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use Tiagolopes\CleanArchitecture\Application\Indication\SendEmail;
use Tiagolopes\CleanArchitecture\Domain\Student\Entity\Student;

readonly class SendEmailSymfonyMailer implements SendEmail
{
    public function __construct(private Mailer $mailer)
    {
    }

    public function mailTo(Student $nominatedStudent): void
    {
        $email = new Email()
            ->from(getenv('MAILER_FROM'))
            ->to((string) $nominatedStudent->email)
            ->subject('Student nomination')
            ->text($this->getMessage($nominatedStudent));

        $this->mailer->send($email);
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
