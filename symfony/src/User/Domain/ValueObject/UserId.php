<?php

namespace App\User\Domain\ValueObject;

class UserId
{
    private string $value;

    /**
     * UserId ValueObject constructor.
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
