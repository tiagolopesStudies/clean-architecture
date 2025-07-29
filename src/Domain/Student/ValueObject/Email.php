<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Domain\Student\ValueObject;

use InvalidArgumentException;
use Stringable;

class Email implements Stringable
{
    private string $value {
        set {
            if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
                throw new InvalidArgumentException('Invalid email address');
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
