<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    public $primaryKey = 'name';

    protected $fillable = [
        'name',
        'id',
        'f_min',
        'min_accr',
        'val_shift',
        'is_direct',
        'max_stat'
    ];

    public function description()
    {
        return $this->hasOne(StatDescription::class, 'stat_name', 'name');
    }
}
