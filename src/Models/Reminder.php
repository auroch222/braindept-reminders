<?php

namespace Braindept\Reminder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reminder extends Model
{
    use SoftDeletes;

    protected $table = 'reminders';

    public $fillable = [
        'reminder_date',
        'source_id',
        'source_type',
        'note',
        'reminder_type_id',
    ];
}
