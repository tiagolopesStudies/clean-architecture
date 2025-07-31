<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Infra\Provider;

use Tiagolopes\CleanArchitecture\Domain\Provider\PasswordEncryptorProvider;

class PasswordEncryptorMd5 implements PasswordEncryptorProvider
{
    public function encrypt(string $password): string
    {
        return md5($password);
    }

    public function verify(string $password, string $passwordHash): bool
    {
        return md5($password) === $passwordHash;
    }
}
