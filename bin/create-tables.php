<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Tiagolopes\CleanArchitecture\Infra\Database\PdoConnection;

$sqlCreateTableStudent = <<<SQL
    CREATE TABLE IF NOT EXISTS student(
        id SERIAL PRIMARY KEY,
        cpf VARCHAR(11) NOT NULL UNIQUE,
        name VARCHAR(80) NOT NULL,
        email VARCHAR(100) NOT NULL
    );
SQL;

$sqlCreateTablePhone = <<<SQL
    CREATE TABLE IF NOT EXISTS phone(
        id SERIAL PRIMARY KEY,
        student_id INTEGER NOT NULL,
        ddd VARCHAR(2) NOT NULL,
        number VARCHAR(9) NOT NULL,
        FOREIGN KEY (student_id) REFERENCES student(id) ON DELETE CASCADE
    );
SQL;

$connection = PdoConnection::getInstance();
$connection->exec($sqlCreateTableStudent);
$connection->exec($sqlCreateTablePhone);
