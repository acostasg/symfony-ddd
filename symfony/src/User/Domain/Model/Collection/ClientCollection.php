<?php

namespace App\User\Domain\Model\Collection;

use App\User\Domain\Model\Client;
use Exception;
use Iterator;

class ClientCollection implements Iterator
{
    private int $iterator;

    /** @var Client[] */
    private array $clients;

    /**
     * ClientCollection constructor.
     */
    public function __construct(array $clients = [])
    {
        $this->clients = $clients;
        $this->iterator = 0;
    }

    /**
     * @throws Exception
     */
    public function get(int $position): Client
    {
        if (isset($this->clients[$position])) {
            return $this->clients[$position];
        }

        throw new Exception('Invalid position');
    }

    public function add(Client $client): void
    {
        $this->clients[] = $client;
    }

    public function remove(Client $client): void
    {
        if (($key = array_search($client, $this->clients)) !== false) {
            unset($this->clients[$key]);
        }
    }

    public function current(): Client
    {
        return $this->clients[$this->iterator];
    }

    public function next(): void
    {
        ++$this->iterator;
    }

    public function key(): int
    {
        return $this->iterator;
    }

    public function valid(): bool
    {
        return isset($this->clients[$this->iterator]);
    }

    public function rewind(): void
    {
        $this->iterator = 0;
    }
}
