<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Domain\Student\ValueObject;

use InvalidArgumentException;
use Stringable;

class Phone implements Stringable
{
    private(set) string $ddd {
        set {
            if (preg_match('/^\d{2}$/', $value) !== 1) {
                throw new InvalidArgumentException('Invalid DDD number');
            }
            $this->ddd = $value;
        }
    }
    private(set) string $number {
        set {
            if (preg_match('/^\d{8,9}$/', $value) !== 1) {
                throw new InvalidArgumentException('Invalid phone number');
            }
            $this->number = $value;
        }
    }
    private function __construct(
        string $ddd,
        string $number
    ) {
        $this->ddd    = $ddd;
        $this->number = $number;
    }

    public static function create(string $ddd, string $number): self
    {
        return new self($ddd, $number);
    }

    public function __toString(): string
    {
        return "($this->ddd) $this->number";
    }
}
