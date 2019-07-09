<?php


namespace Braindept\Reminder\Repositories;


use Braindept\Reminder\Models\Reminder;
use Illuminate\Database\Eloquent\Collection;

interface ReminderRepositoryInterface
{

    /**
     * Get reminder by id
     *
     * @param int $reminderId
     * @return Reminder|null
     */
    public function get(int $reminderId): ?Reminder;


    /**
     * Get all reminders
     *
     * @return Collection
     */
    public function all(): Collection;


    /**
     * Delete a reminder by it's ID
     *
     * @param int
     * @return bool
     */
    public function delete(int $reminderId): bool;


    /**
     * Create Reminder
     *
     * @param array $data
     * @return Reminder
     */
    public function create(array $data): Reminder;


    /**
     * Updates a reminder.
     *
     * @param int
     * @param array
     * @return Reminder
     */
    public function update(int $reminderId, array $data): Reminder;

    /**
     * Get reminders by source_type and source_id
     *
     * @param string $sourceType
     * @param int $sourceId
     * @return Collection
     */
    public function getRemindersByTypeAndSourceId(string $sourceType, int $sourceId): Collection;
}
