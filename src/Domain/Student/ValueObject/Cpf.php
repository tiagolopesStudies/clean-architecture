<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Domain\Student\ValueObject;

use InvalidArgumentException;
use Stringable;

class Cpf implements Stringable
{
    private string $value {
        set {
            $regexCpf = '/^(\d{3})(\d{3})(\d{3})(\d{2})$/';
            $options  = ['regexp' => $regexCpf];

            if (filter_var($value, FILTER_VALIDATE_REGEXP, compact('options')) === false) {
                throw new InvalidArgumentException('Invalid CPF number');
            }

            $this->value = $value;
        }
    }
    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function create(string $value): self
    {
        return new self($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
