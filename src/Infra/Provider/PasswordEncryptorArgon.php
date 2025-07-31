<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Infra\Provider;

use Tiagolopes\CleanArchitecture\Domain\Provider\PasswordEncryptorProvider;

class PasswordEncryptorArgon implements PasswordEncryptorProvider
{
    private const string HASH_ALGORITHM = PASSWORD_ARGON2I;

    public function encrypt(string $password): string
    {
        return password_hash($password, self::HASH_ALGORITHM);
    }

    public function verify(string $password, string $passwordHash): bool
    {
        return password_verify($password, $passwordHash);
    }
}
