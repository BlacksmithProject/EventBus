# BlacksmithProject - EventBus

## Why ?

In order to improve my skills, I'm doing my own implementation of an
EventBus.

## Installation

## How to use it ?

- Your events need to implement the empty interface `\BSP\Event`
- Your listeners need to implement the interface `\BSP\EventListener`
- Extends `\BSP\EventBus` and add in your constructor the listeners.

> Please note that there may be multiple listeners to a single event.

You can look for example in the [tests/Mock]() folder.

Now, you only need to inject your EventBus and send Events.

### Example:

```php
public function __construct(EventBus $eventBus)
{
    $this->eventBus = $eventBus
}

public function handle(DoSomething $doSomething): void
{
    // do business logic

    $event = new SomethingDone();

    $this->eventBus->send($event);
}
```