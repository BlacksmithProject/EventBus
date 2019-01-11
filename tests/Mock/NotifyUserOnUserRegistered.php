<?php
declare(strict_types=1);

namespace BSP\Tests\Mock;

use BSP\Event;
use BSP\EventListener;

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
