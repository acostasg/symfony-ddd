<?php

namespace App\User\Infrastructure\Repository\Doctrine\Mapping;

use App\User\Domain\Model\Client;
use App\User\Domain\Model\Factory\ClientFactory;
use App\User\Domain\ValueObject\UserId;
use Doctrine\ORM\Mapping as ORM;

/**
 * ClientMapper.
 *
 * @ORM\Table (name="Client")
 * @ORM\Entity (repositoryClass="App\User\Infrastructure\Repository\Doctrine\ClientRepository")
 */
class ClientMapper
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

    /**
     * @ORM\Column(type="string", length=150)
     */
    private string $mail;

    public function __construct(Client $client = null)
    {
        if (null != $client) {
            $this->id = $client->getId()->getValue();
            $this->firstName = $client->getFirstName();
            $this->lastName = $client->getLastName();
            $this->mail = $client->getMail();
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

    public function getMail(): string
    {
        return $this->mail;
    }

    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    public function build(): Client
    {
        return ClientFactory::build(
            new UserId($this->id),
            $this->firstName,
            $this->lastName,
            $this->mail
        );
    }
}
