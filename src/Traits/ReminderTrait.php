<?php


namespace Braindept\Reminder\Traits;

use Braindept\Reminder\Repositories\ReminderRepositoryInterface;

trait ReminderTrait
{
    public function createReminder(int $sourceId, string $reminderDate, string $note, string $reminderType)
    {
        $reminderRepository = resolve('Braindept\Reminder\Repositories\ReminderRepositoryInterface');

        var_dump($this->getCalledModelName());
    }

    public function getCalledModelName(): string
    {
        $calledClass = get_called_class();
        $data = explode('\\', $calledClass);

        return strtoupper(end($data));
    }

}
