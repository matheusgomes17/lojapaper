<?php

namespace Snaketec\Listeners\Frontend\Auth;

/**
 * Class UserEventListener.
 */
class UserEventListener
{
    /**
     * @param $event
     */
    public function onLoggedIn($event)
    {
        \Log::info('User Logged In: '.$event->user->name);
    }

    /**
     * @param $event
     */
    public function onLoggedOut($event)
    {
        \Log::info('User Logged Out: '.$event->user->name);
    }

    /**
     * @param $event
     */
    public function onRegistered($event)
    {
        \Log::info('User Registered: '.$event->user->name);
    }

    /**
     * @param $event
     */
    public function onConfirmed($event)
    {
        \Log::info('User Confirmed: '.$event->user->name);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \Snaketec\Events\Frontend\Auth\UserLoggedIn::class,
            'Snaketec\Listeners\Frontend\Auth\UserEventListener@onLoggedIn'
        );

        $events->listen(
            \Snaketec\Events\Frontend\Auth\UserLoggedOut::class,
            'Snaketec\Listeners\Frontend\Auth\UserEventListener@onLoggedOut'
        );

        $events->listen(
            \Snaketec\Events\Frontend\Auth\UserRegistered::class,
            'Snaketec\Listeners\Frontend\Auth\UserEventListener@onRegistered'
        );

        $events->listen(
            \Snaketec\Events\Frontend\Auth\UserConfirmed::class,
            'Snaketec\Listeners\Frontend\Auth\UserEventListener@onConfirmed'
        );
    }
}
