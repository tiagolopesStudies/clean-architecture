<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Infra\Database;

use PDO;

class PdoConnection extends PDO
{
    private static ?self $instance = null;
    public function __construct()
    {
        $driver = 'pgsql';
        $config = [
            'host'   => 'localhost',
            'port'   => '5432',
            'dbname' => 'clean-architecture',
        ];

        $queryString = $driver . ':' . http_build_query(data: $config, arg_separator: ';');

        parent::__construct(
            dsn: $queryString,
            username: 'docker',
            password: 'docker'
        );
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
