<?php


namespace Braindept\Reminder\Traits;


use Carbon\Carbon;

trait ReminderTrait
{


    /**
     * @param int $sourceId
     * @param string $reminderDate
     * @param string $note
     * @param int $reminderType
     * @param int|null $userId
     * @return mixed
     */
    public function createReminder(int $sourceId, string $reminderDate, string $note, int $reminderType, ?int $userId)
    {
        $reminderRepository = resolve('Braindept\Reminder\Repositories\ReminderRepositoryInterface');
        $sourceType = $this->getCalledModelName();

        $data = [
            'reminder_date' => Carbon::parse($reminderDate),
            'source_id' => $sourceId,
            'source_type' => $sourceType,
            'note' => $note,
            'reminder_type_id' => $reminderType,
            'user_id' => $userId
        ];

        return $reminderRepository->create($data);
    }

    public function deactivateReminder(int $id)
    {

    }

    /**
     * @return string
     */
    public function getCalledModelName(): string
    {
        $calledClass = get_called_class();
        $data = explode('\\', $calledClass);

        return strtoupper(end($data));
    }

}
