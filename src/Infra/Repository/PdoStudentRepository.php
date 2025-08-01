<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Infra\Repository;

use PDO;
use Tiagolopes\CleanArchitecture\Domain\Exception\StudentNotFound;
use Tiagolopes\CleanArchitecture\Domain\Student\Entity\Student;
use Tiagolopes\CleanArchitecture\Domain\Student\Repository\StudentRepository;
use Tiagolopes\CleanArchitecture\Infra\Database\PdoConnection;

readonly class PdoStudentRepository implements StudentRepository
{
    public function __construct(private PdoConnection $connection)
    {
    }

    public function create(Student $student): void
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

        $stmt      = $this->connection->prepare($sqlInsertPhones);
        $studentId = (int) $this->connection->lastInsertId();

        foreach ($student->phones as $phone) {
            $stmt->execute([
                'STUDENT_ID' => $studentId,
                'DDD' => $phone->ddd,
                'NUMBER' => $phone->number,
            ]);
        }
    }

    public function update(Student $student): void
    {
        $sql = <<<SQL
            UPDATE student SET cpf = :CPF, name = :NAME, email = :EMAIL WHERE id = :ID;
        SQL;

        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'ID' => (int) $student->id,
            'CPF' => $student->cpf,
            'NAME' => $student->name,
            'EMAIL' => $student->email,
        ]);

        $sqlUpdatePhones = <<<SQL
            UPDATE phone SET ddd = :DDD, number = :NUMBER WHERE student_id = :STUDENT_ID;
        SQL;

        $stmt = $this->connection->prepare($sqlUpdatePhones);
        foreach ($student->phones as $phone) {
            $stmt->execute([
                'STUDENT_ID' => (int) $student->id,
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
            throw StudentNotFound::fromCpf($cpf);
        }

        $student = Student::createFromArray($studentArray);
        $phones  = $this->findStudentPhones((int) $student->id);

        foreach ($phones as $phone) {
            $student->addPhone($phone['ddd'], $phone['number']);
        }

        return $student;
    }

    public function findAll(): array
    {
        $sql = <<<SQL
            SELECT * FROM student;
        SQL;

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $studentsArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(function($student) {
            $student = Student::createFromArray($student);
            $phones  = $this->findStudentPhones((int) $student->id);

            foreach ($phones as $phone) {
                $student->addPhone($phone['ddd'], $phone['number']);
            }

            return $student;
        }, $studentsArray);
    }

    private function findStudentPhones(int $studentId): array
    {
        $sql = <<<SQL
            SELECT * FROM phone WHERE student_id = :STUDENT_ID;
        SQL;

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('STUDENT_ID', $studentId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
