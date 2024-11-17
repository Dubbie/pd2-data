<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyStat extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'set_stat',
        'value',
        'function',
        'stat_name',
        'property_code'
    ];

    protected $with = ['stat'];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_code', 'code');
    }

    public function stat()
    {
        return $this->belongsTo(Stat::class, 'stat_name', 'name');
    }
}
