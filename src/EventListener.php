<?php
declare(strict_types=1);

namespace BSP\EventBus;

interface EventListener
{
    public function listen(Event $event): void;
}
