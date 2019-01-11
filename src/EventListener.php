<?php
declare(strict_types=1);

namespace BSP;

interface EventListener
{
    public function listen(Event $event): void;
}
