<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Domain\Provider;

interface PasswordEncryptorProvider
{
    public function encrypt(string $password): string;

    public function verify(string $password, string $passwordHash): bool;
}
