<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public const MAX_STATS = 7;

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'code';

    protected $fillable = [
        'code',
        'is_done'
    ];

    protected $with = ['propertyStats'];

    public function propertyStats()
    {
        return $this->hasMany(PropertyStat::class, 'property_code', 'code');
    }
}
