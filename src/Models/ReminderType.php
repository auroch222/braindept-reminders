<?php

namespace Braindept\Reminder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReminderType extends Model
{
    use SoftDeletes;

    protected $table = 'reminder_types';

    public $fillable = [
        'name',
        'key',
    ];
}
