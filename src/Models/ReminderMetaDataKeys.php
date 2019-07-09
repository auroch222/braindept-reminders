<?php

namespace Braindept\Reminder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReminderMetaDataKeys extends Model
{
    use SoftDeletes;

    protected $table = 'reminder_meta_data_keys';

    public $fillable = [
        'name',
        'key',
    ];
}
