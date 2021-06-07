<?php

namespace App\User\Domain\Model;

use App\Core\Domain\Model\AbstractModel;
use App\User\Domain\ValueObject\UserId;

class Client extends AbstractModel
{
    private User $user;

    private string $mail;

    /**
     * ClientMapper constructor.
     */
    public function __construct(User $user, string $mail)
    {
        $this->user = $user;
        $this->mail = $mail;
    }

    public function getId(): UserId
    {
        return $this->user->getId();
    }

    public function getFirstName(): string
    {
        return $this->user->getFirstName();
    }

    public function getLastName(): string
    {
        return $this->user->getLastName();
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }
}
