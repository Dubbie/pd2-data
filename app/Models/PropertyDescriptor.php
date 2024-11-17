<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyDescriptor extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'param',
        'min',
        'max',
        'property_code',
        'describable_id',
        'describable_type'
    ];

    protected $with = ['property'];

    public function describable()
    {
        return $this->morphTo();
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_code', 'code');
    }
}
