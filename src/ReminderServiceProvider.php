<?php

namespace Braindept\Reminder;

use Illuminate\Support\ServiceProvider;
// Repos
use Braindept\Reminder\Repositories\ReminderRepositoryInterface;
use Braindept\Reminder\Repositories\ReminderRepository;
// Commands
use Braindept\Reminder\Console\InsertReminderTypes;

class ReminderServiceProvider extends ServiceProvider
{
    private const REPOSITORIES = [
        ReminderRepositoryInterface::class => ReminderRepository::class,
    ];

    protected $commands = [
        InsertReminderTypes::class,
    ];

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    public function register()
    {
        $this->commands($this->commands);

        foreach (self::REPOSITORIES as $interface => $repo) {
            $this->app->bind($interface, $repo);
        }
    }
}
