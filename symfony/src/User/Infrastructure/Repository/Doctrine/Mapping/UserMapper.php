<?php

namespace App\User\Infrastructure\Repository\Doctrine\Mapping;

use App\User\Domain\Model\User;
use App\User\Domain\ValueObject\UserId;
use Doctrine\ORM\Mapping as ORM;

/**
 * ClientMapper.
 *
 * @ORM\Table (name="User")
 * @ORM\Entity (repositoryClass="App\User\Infrastructure\Repository\Doctrine\UserRepository")
 */
class UserMapper
{
    /**
     * @ORM\Column(type="string", length=150)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private string $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private string $lastName;

    public function __construct(User $user = null)
    {
        if (null != $user) {
            $this->id = $user->getId()->getValue();
            $this->firstName = $user->getFirstName();
            $this->lastName = $user->getLastName();
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function build(): User
    {
        return new User(
            new UserId($this->id),
            $this->firstName,
            $this->lastName,
        );
    }
}
