<?php

namespace Modules\Iquiz\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Modules\Iquiz\Events\UserPollWasCreated;
use Modules\Iquiz\Events\Handlers\CheckPoints;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserPollWasCreated::class => [
            CheckPoints::class,
        ]
    ];
}