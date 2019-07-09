<?php


namespace Braindept\Reminder\Repositories;

use Braindept\Reminder\Models\Reminder;
use Illuminate\Database\Eloquent\Collection;

class ReminderRepository implements ReminderRepositoryInterface
{
    /**
     * @param int $reminderId
     * @return Reminder|null
     */
    public function get(int $reminderId): ?Reminder
    {
        return Reminder::find($reminderId);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Reminder::all();
    }

    /**
     * @param int $reminderId
     * @return bool
     */
    public function delete(int $reminderId): bool
    {
        if (Reminder::find($reminderId)->delete()) {
            return true;
        }

        return false;
    }

    /**
     * @param array $data
     * @return Reminder
     */
    public function create(array $data): Reminder
    {
        $reminder = Reminder::create($data);

        return $reminder;
    }

    /**
     * @param int $reminderId
     * @param array $data
     * @return Reminder
     */
    public function update(int $reminderId, array $data): Reminder
    {
        $reminder = Reminder::find($reminderId);
        $reminder->update($data);

        return $reminder;
    }

    /**
     * @param string $sourceType
     * @param int $sourceId
     * @return Collection
     */
    public function getRemindersByTypeAndSourceId(string $sourceType, int $sourceId): Collection
    {
        $reminders = Reminder::where('source_type', $sourceType)->where('source_id', $sourceId)->get();

        return $reminders;
    }
}
