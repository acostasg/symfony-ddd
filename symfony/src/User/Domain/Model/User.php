<?php

namespace App\User\Domain\Model;

use App\Core\Domain\Model\AbstractModel;
use App\User\Domain\ValueObject\UserId;

class User extends AbstractModel
{
    private UserId $id;

    private string $firstName;

    private string $lastName;

    /**
     * User constructor.
     */
    public function __construct(UserId $id, string $firstName, string $lastName)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
}
