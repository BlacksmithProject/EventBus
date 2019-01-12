<?php
declare(strict_types=1);

namespace BSP\EventBus\Tests\Mock;

use BSP\EventBus\Event;
use BSP\EventBus\EventListener;

final class NotifyUserOnUserRegistered implements EventListener
{
    /**
     * @param UserRegistered $event
     */
    public function listen(Event $event): void
    {
        $user = $event->user();

        $user::$messages += 1;
    }
}
