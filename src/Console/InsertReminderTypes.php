<?php

namespace Braindept\Reminder\Console;


use Illuminate\Console\Command;
use Braindept\Reminder\Models\ReminderType;

class InsertReminderTypes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:insert-reminder-types {--type=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reminder type seeder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $defaultTypes = [
            'ptp',
            'client_reminder',
            'loan_reminder',
        ];

        if ($this->option('type') != null) {
            array_push($defaultTypes, $this->option('type'));
        }

        foreach ($defaultTypes as $type) {
            ReminderType::firstOrCreate([
                'name' => $type,
                'key' => strtoupper($type),
            ]);
        }
    }
}
