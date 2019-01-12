<?php
declare(strict_types=1);

namespace BSP\EventBus\Tests\Mock;

use BSP\EventBus\Event;
use BSP\EventBus\EventListener;

final class UpdateUserListOnUserRegistered implements EventListener
{
    /**
     * @param UserRegistered $event
     */
    public function listen(Event $event): void
    {
        UserList::$list[] = $event->user();
    }
}
