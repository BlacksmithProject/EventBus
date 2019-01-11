<?php
declare(strict_types=1);

namespace BSP\Tests\Mock;

use BSP\Event;

final class UserRegistered implements Event
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function user(): User
    {
        return $this->user;
    }
}
