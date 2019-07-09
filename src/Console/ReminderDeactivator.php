<?php

namespace Braindept\Reminder\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Braindept\Reminder\Repositories\ReminderRepositoryInterface;
use Braindept\Reminder\Repositories\ReminderMetaDataRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ReminderDeactivator extends Command
{
    protected $reminderRepo;
    protected $reminderMetaDataRepo;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:deactivator {type} {days-range}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reminder deactivator cron job';

    /**
     * Create a new command instance.
     *
     * @param ReminderRepositoryInterface $reminderRepo
     */
    public function __construct(
        ReminderRepositoryInterface $reminderRepo,
        ReminderMetaDataRepositoryInterface $reminderMetaDataRepo
    )
    {
        $this->reminderRepo = $reminderRepo;
        $this->reminderMetaDataRepo = $reminderMetaDataRepo;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $deactivatorType = $this->argument('type');
        $daysRange = $this->argument('days-range');

        $this->reminderRepo->getRemindersByTypeAndDayRange($deactivatorType, $daysRange)
            ->chunk(500, function ($reminders) {
                foreach ($reminders as $reminder) {
                    try {
                        DB::transaction(function () use ($reminder) {
                            $this->reminderRepo->delete($reminder->id);
                            $this->reminderMetaDataRepo->create([
                                'reminder_id' => $reminder->id,
                                'key_id' => config('reminder.reminder_meta_data_keys.deactivator_user'),
                                'value' => 1,
                            ]);
                        }, 1);
                    } catch (\Exception $e) {
                        \Log::info(
                            'REMINDER_DEACTIVATOR_ERROR',
                            [
                                'error_message' => $e->getMessage()
                            ]
                        );
                        continue;
                    }
                }
            });

    }
}
