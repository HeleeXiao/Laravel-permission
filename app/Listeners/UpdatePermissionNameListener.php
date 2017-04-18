<?php

namespace App\Listeners;

use App\Events\UpdatePermissionNameEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdatePermissionNameListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UpdatePermissionNameEvent  $event
     * @return void
     */
    public function handle(UpdatePermissionNameEvent $event)
    {
        $event->permission->name = $event->permission->display_name ;
        $event->permission->save();
    }
}
