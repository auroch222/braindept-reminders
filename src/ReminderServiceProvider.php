<?php

namespace Braindept\Reminder;

use Illuminate\Support\ServiceProvider;

class ReminderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    public function register()
    {
        //
    }
}
