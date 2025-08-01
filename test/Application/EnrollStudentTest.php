<?php

namespace Test\Application;

use PHPUnit\Framework\TestCase;
use Tiagolopes\CleanArchitecture\Application\Student\EnrollStudent\EnrollStudentAction;
use Tiagolopes\CleanArchitecture\Application\Student\EnrollStudent\EnrollStudentDto;
use Tiagolopes\CleanArchitecture\Infra\Repository\InMemoryStudentRepository;

class EnrollStudentTest extends TestCase
{
    public function testEnrollStudent(): void
    {
        $enrollStudentDto = new EnrollStudentDto(
            cpf: '12345654378',
            name: 'Joãozinho',
            email: 'teste@gmail.com',
        );

        $studentRepository = new InMemoryStudentRepository();
        $enrollStudent     = new EnrollStudentAction($studentRepository);
        $enrollStudent->execute($enrollStudentDto);

        $student = $studentRepository->getByCpf($enrollStudentDto->cpf);
        $this->assertSame($enrollStudentDto->cpf, (string) $student->cpf);
        $this->assertSame($enrollStudentDto->name, $student->name);
        $this->assertSame($enrollStudentDto->email, (string) $student->email);
    }
}
