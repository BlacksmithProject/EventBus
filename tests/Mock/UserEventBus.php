<?php
declare(strict_types=1);

namespace BSP\EventBus\Tests\Mock;

use BSP\EventBus\EventBus;

final class UserEventBus extends EventBus
{
    public function __construct(
        NotifyUserOnUserRegistered $notifyUserOnUserRegistered,
        UpdateUserListOnUserRegistered $updateUserListOnUserRegistered
    ) {
        $this->listeners[UserRegistered::class][] = $notifyUserOnUserRegistered;
        $this->listeners[UserRegistered::class][] = $updateUserListOnUserRegistered;
    }
}
