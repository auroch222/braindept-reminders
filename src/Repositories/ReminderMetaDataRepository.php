<?php


namespace Braindept\Reminder\Repositories;

use Braindept\Reminder\Models\ReminderMetaData;

class ReminderMetaDataRepository implements ReminderMetaDataRepositoryInterface
{
    /**
     * @param int $metaDataId
     * @return ReminderMetaData|null
     */
    public function get(int $metaDataId): ?ReminderMetaData
    {
        return ReminderMetaData::find($metaDataId);
    }

    /**
     * @param array $data
     * @return ReminderMetaData
     */
    public function create(array $data): ReminderMetaData
    {
        return ReminderMetaData::create($data);
    }
}
