<?php
declare(strict_types=1);

namespace BSP\Tests;

use BSP\DrWatson\ExceptionType;
use BSP\EventBus;
use BSP\EventBusException;
use BSP\Tests\Mock\NotifyUserOnUserRegistered;
use BSP\Tests\Mock\UpdateUserListOnUserRegistered;
use BSP\Tests\Mock\User;
use BSP\Tests\Mock\UserAuthenticated;
use BSP\Tests\Mock\UserEventBus;
use BSP\Tests\Mock\UserList;
use BSP\Tests\Mock\UserRegistered;
use PHPUnit\Framework\TestCase;

final class EventBusTest extends TestCase
{
    /**
     * @var EventBus
     */
    private $eventBus;

    public function setUp()
    {
        $listener1 = new NotifyUserOnUserRegistered();
        $listener2 = new UpdateUserListOnUserRegistered();

        $this->eventBus = new UserEventBus($listener1, $listener2);
    }

    /**
     * @throws EventBusException
     */
    public function testEventBus(): void
    {
        $user = new User();

        $event = new UserRegistered($user);

        $this->assertSame(0, $user::$messages);
        $this->assertCount(0, UserList::$list);

        $this->eventBus->send($event);

        $this->assertSame(1, $user::$messages);
        $this->assertCount(1, UserList::$list);
    }

    public function testCannotListenToUndeclaredEvent(): void
    {
        try {
            $event = new UserAuthenticated();

            $this->eventBus->send($event);
        } catch (EventBusException $exception) {
            $this->assertTrue(ExceptionType::DOMAIN()->equals($exception->type()));
            $this->assertSame('domain.eventbus.event.unkown', $exception->message());
            $this->assertSame('"BSP\Tests\Mock\UserEventBus" listeners.', $exception->suspect());
            $this->assertSame(
                'You may have forgot to add the "BSP\Tests\Mock\UserAuthenticated" event to the "BSP\Tests\Mock\UserEventBus" eventBus.',
                $exception->help()
            );
        }
    }
}
