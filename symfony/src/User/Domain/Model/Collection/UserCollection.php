<?php

namespace App\User\Domain\Model\Collection;

use App\User\Domain\Model\User;
use Exception;
use Iterator;

class UserCollection implements Iterator
{
    private int $iterator;

    /** @var User[] */
    private array $users;

    /**
     * UserCollection constructor.
     */
    public function __construct(array $users = [])
    {
        $this->users = $users;
        $this->iterator = 0;
    }

    /**
     * @throws Exception
     */
    public function get(int $position): User
    {
        if (isset($this->users[$position])) {
            return $this->users[$position];
        }

        throw new Exception('Invalid position');
    }

    public function add(User $user): void
    {
        $this->users[] = $user;
    }

    public function remove(User $user): void
    {
        if (($key = array_search($user, $this->users)) !== false) {
            unset($this->users[$key]);
        }
    }

    public function current(): User
    {
        return $this->users[$this->iterator];
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
        return isset($this->users[$this->iterator]);
    }

    public function rewind(): void
    {
        $this->iterator = 0;
    }
}
