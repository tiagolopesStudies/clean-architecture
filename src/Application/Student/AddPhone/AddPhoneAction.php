<?php

declare(strict_types=1);

namespace Tiagolopes\CleanArchitecture\Application\Student\AddPhone;

use Tiagolopes\CleanArchitecture\Domain\Student\Repository\StudentRepository;

readonly class AddPhoneAction
{
    public function __construct(private StudentRepository $repository)
    {
    }

    public function execute(AddPhoneDto $addPhoneDto): void
    {
        $student = $this->repository->getByCpf($addPhoneDto->studentCpf);

        $student->addPhone($addPhoneDto->ddd, $addPhoneDto->phone);
        $this->repository->update($student);
    }
}
