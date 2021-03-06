<?php


namespace Braindept\Reminder\Traits;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait ReminderTrait
{


    /**
     * @param string $reminderDate
     * @param string $note
     * @param int $reminderType
     * @param int $userId
     * @return mixed
     */
    public function createReminder(string $reminderDate, string $note, int $reminderType, int $userId)
    {
        $reminderRepository = resolve('Braindept\Reminder\Repositories\ReminderRepositoryInterface');
        $sourceType = $this->getCalledModelName();

        $data = [
            'reminder_date' => Carbon::parse($reminderDate),
            'source_id' => $this->id,
            'source_type' => $sourceType,
            'note' => $note,
            'reminder_type_id' => $reminderType,
            'user_id' => $userId
        ];

        return $reminderRepository->create($data);
    }

    /**
     * @param int $reminderId
     * @param int $userId
     */
    public function deactivateReminder(int $reminderId, int $userId)
    {
        DB::transaction(function () use ($reminderId, $userId) {
            $reminderRepository = resolve('Braindept\Reminder\Repositories\ReminderRepositoryInterface');
            $reminderMetaDataRepository = resolve('Braindept\Reminder\Repositories\ReminderMetaDataRepositoryInterface');

            $reminderRepository->delete($reminderId);
            $reminderMetaDataRepository->create([
                'reminder_id' => $reminderId,
                'key_id' => config('reminder.reminder_meta_data_keys.deactivator_user'),
                'value' => $userId,
            ]);
        }, 1);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getReminders()
    {
        $reminderRepository = resolve('Braindept\Reminder\Repositories\ReminderRepositoryInterface');
        $sourceType = $this->getCalledModelName();

        return $reminderRepository->getByTypeAndSourceId(
            $sourceType,
            $this->id
        );
    }

    /**
     * @return string
     */
    public function getCalledModelName(): string
    {
        return get_called_class();
    }

    /**
     * @return mixed
     */
    public function relatedReminders()
    {
        $reminderRepository = resolve('Braindept\Reminder\Repositories\ReminderRepositoryInterface');

        return $reminderRepository->getRelatedReminders($this);
    }

    /**
     * @param string $sourceType
     * @param int $daysRange
     * @return mixed
     */
    public function getByTypeAndDayRange(string $sourceType, int $daysRange)
    {
        $reminderRepository = resolve('Braindept\Reminder\Repositories\ReminderRepositoryInterface');

        return $reminderRepository->getByTypeAndDayRange($sourceType, $daysRange);
    }
}
