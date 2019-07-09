<?php


namespace Braindept\Reminder\Repositories;


use Braindept\Reminder\Models\ReminderMetaData;

interface ReminderMetaDataRepositoryInterface
{
    /**
     * @param int $metaDataId
     * @return ReminderMetaData|null
     */
    public function get(int $metaDataId): ?ReminderMetaData;

    /**
     * @param array $data
     * @return ReminderMetaData
     */
    public function create(array $data): ReminderMetaData;
}
