<?php
declare(strict_types=1);

namespace BSP;

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

    public function send(Event $event): void
    {
        if (isset($this->listeners[get_class($event)])) {
            foreach ($this->listeners[get_class($event)] as $listener) {
                $listener->listen($event);
            }
        }
    }
}
