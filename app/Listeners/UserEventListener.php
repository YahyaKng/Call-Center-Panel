<?php

namespace App\Listeners;

class UserEventListener 
{
    /**
     * Handle user login events.
     */
    public function onUserLogin($event) {
        // if (asteriskAddToQueues(auth()->user()->team()->first()->queues, auth()->user()->line)->isSuccess()) {
        //     $request->session()->flash('asteriskStatus', 'Added to queues successfully...');
        // }
        $queues = auth()->user()->team()->first()->queues;
        if ($queues) {
            asteriskAddToQueues($queues, auth()->user()->line);
        }
        // asteriskStatusAction();
    }

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event) {
        $queues = auth()->user()->team()->first()->queues;
        if ($queues) {
            asteriskRemoveFromQueues($queues, auth()->user()->line);
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventListener@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventListener@onUserLogout'
        );
    }

}