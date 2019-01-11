<?php
declare(strict_types=1);

namespace BSP\Tests;

use BSP\Tests\Mock\NotifyUserOnUserRegistered;
use BSP\Tests\Mock\UpdateUserListOnUserRegistered;
use BSP\Tests\Mock\User;
use BSP\Tests\Mock\UserEventBus;
use BSP\Tests\Mock\UserList;
use BSP\Tests\Mock\UserRegistered;
use PHPUnit\Framework\TestCase;

final class EventBusTest extends TestCase
{
    public function testEventBus(): void
    {
        $user = new User();

        $event = new UserRegistered($user);

        $listener1 = new NotifyUserOnUserRegistered();
        $listener2 = new UpdateUserListOnUserRegistered();

        $eventBus = new UserEventBus($listener1, $listener2);

        $this->assertSame(0, $user::$messages);
        $this->assertCount(0, UserList::$list);

        $eventBus->send($event);

        $this->assertSame(1, $user::$messages);
        $this->assertCount(1, UserList::$list);
    }
}
