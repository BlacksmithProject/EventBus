<?php
declare(strict_types=1);

namespace BSP\EventBus;

use BSP\DrWatson\ExceptionType;

/**
 * EventBus execute listeners listening to a particular event.
 *
 * In order to do so, EventBus::listeners needs to be filled with listeners in its constructor:
 * Please pay attention that there can be multiple listeners to an Event.
 *
 * Exemple:
 * public function __constructor(DoSomethingOnDomainEvent $doSomethingOnDomainEvent) {
 *     $this->listeners[DomainEvent::class][] = $DoSomethingOnDomainEvent;
 * }
 */
abstract class EventBus
{
    /** @var EventListener[][] */
    protected $listeners = [];

    /**
     * @throws EventBusException
     */
    public function send(Event $event): void
    {
        if (!isset($this->listeners[get_class($event)])) {
            throw EventBusException::report(
                ExceptionType::DOMAIN(),
                'domain.eventbus.event.unknown',
                sprintf('"%s" listeners.', static::class),
                sprintf('You may have forgot to add the "%s" event to the "%s" eventBus.', get_class($event), static::class)
            );
        }

        foreach ($this->listeners[get_class($event)] as $listener) {
            $listener->listen($event);
        }
    }
}
