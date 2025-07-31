<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Infra\Repository;

use Exception;
use PDO;
use Tiagolopes\CleanArchitecture\Domain\Student\Entity\Student;
use Tiagolopes\CleanArchitecture\Domain\Student\Repository\StudentRepository;
use Tiagolopes\CleanArchitecture\Infra\Database\PdoConnection;

readonly class PdoStudentRepository implements StudentRepository
{
    public function __construct(private PdoConnection $connection)
    {
    }

    public function store(Student $student): void
    {
        $sql = <<<SQL
            INSERT INTO student (cpf, name, email) VALUES (:CPF, :NAME, :EMAIL);
        SQL;

        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'CPF' => $student->cpf,
            'NAME' => $student->name,
            'EMAIL' => $student->email,
        ]);

        $sqlInsertPhones = <<<SQL
            INSERT INTO phone (student_id, ddd, number) VALUES (:STUDENT_ID, :DDD, :NUMBER);
        SQL;

        $stmt = $this->connection->prepare($sqlInsertPhones);

        foreach ($student->phones as $phone) {
            $stmt->execute([
                'STUDENT_ID' => $this->connection->lastInsertId(),
                'DDD' => $phone->ddd,
                'NUMBER' => $phone->number,
            ]);
        }
    }

    public function getByCpf(string $cpf): Student
    {
        $sql = <<<SQL
            SELECT * FROM student WHERE cpf = :CPF;
        SQL;

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('CPF', $cpf);
        $stmt->execute();

        $studentArray = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($studentArray === false) {
            throw new Exception('Student not found');
        }

        return Student::createFromArray($studentArray);
    }

    public function findAll(): array
    {
        $sql = <<<SQL
            SELECT * FROM student;
        SQL;

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $studentsArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($student) => Student::createFromArray($student), $studentsArray);
    }
}
