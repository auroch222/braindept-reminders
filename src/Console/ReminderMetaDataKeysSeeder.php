<?php

namespace Braindept\Reminder\Console;

use Illuminate\Console\Command;
use Braindept\Reminder\Models\ReminderMetaDataKeys;

class ReminderMetaDataKeysSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:meta-keys-seeder {--key=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'seed reminder meta data keys';

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
        $defaultMetaKeys = [
            'DEACTIVATOR_USER',
        ];

        if ($this->option('key') != null) {
            array_push($defaultMetaKeys, $this->option('key'));
        }

        foreach ($defaultMetaKeys as $key) {
            ReminderMetaDataKeys::firstOrCreate([
                'name' => $key,
                'key' => strtoupper($key),
            ]);
        }
    }
}
