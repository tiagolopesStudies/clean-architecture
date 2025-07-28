<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Entity;

use Tiagolopes\CleanArchitecture\Entity\ValueObject\Cpf;
use Tiagolopes\CleanArchitecture\Entity\ValueObject\Email;
use Tiagolopes\CleanArchitecture\Entity\ValueObject\Phone;

class Student
{
    public Cpf $cpf;
    public string $name;
    public Email $email;
    public Phone $phone;
}
