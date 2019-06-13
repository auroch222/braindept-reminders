<?php

namespace Braindept\Reminder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReminderMetaData extends Model
{
    use SoftDeletes;

    protected $table = 'reminder_meta_data';

    public $fillable = [
        'reminder_id',
        'key_id',
        'value',
    ];
}
