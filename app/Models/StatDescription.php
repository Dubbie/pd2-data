<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatDescription extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'stat_name',
        'priority',
        'value',
        'function',
        'positive_code',
        'positive',
        'negative_code',
        'negative',
        'extra_code',
        'extra',
        'group_function',
        'group_value',
        'group_positive_code',
        'group_positive',
        'group_negative_code',
        'group_negative',
        'group_extra_code',
        'group_extra'
    ];
}
