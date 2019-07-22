<?php


namespace Braindept\Reminder\Repositories;

use Braindept\Reminder\Models\Reminder;
use Carbon\Carbon;
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
        try {
            Reminder::find($reminderId)->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
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
    public function getByTypeAndSourceId(string $sourceType, int $sourceId): Collection
    {
        $reminders = Reminder::withTrashed()
            ->where('source_type', $sourceType)
            ->where('source_id', $sourceId)
            ->orderBy('reminder_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return $reminders;
    }

    /**
     * @param string $sourceType
     * @param int $daysRange
     * @return Reminder|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function getByTypeAndDayRange(string $sourceType, int $daysRange)
    {
        $reminders = Reminder::withTrashed()->where('source_type', strtoupper($sourceType))
            ->whereBetween('reminder_date', [Carbon::now()->subDays($daysRange), Carbon::now()->today()]);

        return $reminders;
    }

    public function getRelatedReminders($obj)
    {
        return $obj->morphMany(
            Reminder::class,
            'source'
        );
    }
}
